@extends('adminLayout')
@section('main')
    <section class="section dashboard">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Deletado</th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->name }}</td>
                        <td>{{ $categoria->deleted_at }}</td>


                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $categorias->withQueryString()->links() }}
        </div>
    </section>
@endsection
