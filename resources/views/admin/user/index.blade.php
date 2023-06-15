@extends('adminLayout')
@section('main')
    <section class="section dashboard">
        <h1>Users</h1>


        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Photo</th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_type }}</td>
                        <td>{{ $user->photo_url }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $users->withQueryString()->links() }}
        </div>
    </section>
@endsection
