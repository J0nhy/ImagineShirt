@can('viewAny', \App\Models\Category::class)
@extends('adminLayout')
@section('main')
<div class="justify-content-end " style="display: flex">

<p>
    <a class="btn btn-success" href="{{ route('categorias.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova categoria</a>
</p>

</div>


    <section class="section dashboard">
        <h1>Categorias</h1><br>
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
                        <td class="button-icon-col">

                            <a class="btn btn-secondary" href="{{ route('categorias.show', ['categoria' => $categoria]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pen" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></a>

                        </td>
                        <td class="button-icon-col">
                            <form method="POST" action="{{ route('categorias.destroy', ['categoria' => $categoria->id]) }}">
                                @csrf

                                @method('DELETE')
                                <button type="submit" name="delete" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></button>
                            </form>
                        </td>
                        <td class="button-icon-col">
                            <form method="POST" action="{{ route('categorias.recover', ['categoria' => $categoria->id]) }}">
                                @csrf

                                @method('PUT')
                                <button type="submit" name="recover" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                      </svg></button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $categorias->withQueryString()->links() }}
        </div>
    </section>
@endsection
@endcan
