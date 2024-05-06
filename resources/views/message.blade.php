@extends("template.main")
@section('title', 'Pesan')
@section('body')
<div class="container-fluid bg-dark text-white py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="  text-white">
                <h1 class="display-1">Success!</h1>
                <p class="lead">{{ $message }}</p>
                <hr class="my-6">
                <p class="lead">
                    <a class="btn btn-light btn-lg bg-success text-white" href="{{ $contactListRoute }}" role="button">See Contact List</a>
                    <a class="btn btn-light btn-lg " href="{{ $formRoute }}" role="button">Back To Form</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
