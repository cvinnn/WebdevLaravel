@extends("template.main")
@section('title', 'Daftar Kontak')
@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-5 mb-5">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2>Contact List</h2>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Pesan</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr>
                                    <td>{{ $contact['name'] }}</td>
                                    <td>{{ $contact['email'] }}</td>
                                    <td>{{ $contact['phone'] }}</td>
                                    <td>{{ $contact['message'] }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('contact.delete', $contact['name']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-m">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada kontak yang tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
