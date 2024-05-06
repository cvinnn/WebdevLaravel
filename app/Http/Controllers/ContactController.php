<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    private function data()
    {
        if (!Cookie::has('contact'))
        {
            return [];
        }

        // Terima as JSON
        $data = Cookie::get('contact');
        $data = \json_decode($data);
        return $data;
    }

    public function View()
    {
        return \view('contact');
    }

    public function ActionContact(Request $request)
    {
        $data = $this->data();
        $d = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            "message" => $request->input('message'),
        ];

        $data[] = $d;

        $data = \json_encode($data);
        $c = Cookie::make("contact", $data, 60*24*30);
        Cookie::queue($c);

    $message = 'Thank you! Your message has been successfully sent. What would you like to do?';
    $viewData = [
        'message' => $message,
        'contactListRoute' => route('contact.list'),
        'formRoute' => route('contact.form'),
    ];

    if ($request->ajax()) {
        return response()->json(['message' => $message, 'options' => $viewData]);
    }

    return view('message')->with($viewData);
    }

    public function ContactList(Request $request)
    {
    $contacts = json_decode($request->cookie('contact'), true);

    return view('contactlist', ['contacts' => $contacts]);
      //  dd($request->cookie('contact'));
    }


public function deleteContact(Request $request, $name)
{
    $contacts = json_decode($request->cookie('contact'), true);

    $index = array_search($name, array_column($contacts, 'name'));

    if ($index !== false) {
        unset($contacts[$index]);

        return redirect()->route('contact.list')->withCookie(cookie()->forever('contact', json_encode(array_values($contacts))));
    }

    return response()->json(['error' => 'Contact not found.'], Response::HTTP_NOT_FOUND);
}
}
