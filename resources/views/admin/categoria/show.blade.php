@can('view', \App\Models\colors::class)
@extends('adminLayout')
@section('main')
    <div>
        @include('admin.categoria.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#confirmationModal"
            data-msgLine1="Quer realmente apagar o curso <strong>&quot;{{ $categoria->name }}&quot;</strong>?"
            data-action="{{ route('categorias.destroy', ['categoria' => $categoria]) }}">
            Apagar Categoria
        </button>
        <a href="{{ route('categorias.edit', ['categoria' => $categoria->slug]) }}" class="btn btn-secondary ms-3">Alterar Categoria</a>
    </div>


@endsection
@endcan
