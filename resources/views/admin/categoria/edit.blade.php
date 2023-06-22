
@extends('adminLayout')

@section('main')
    <form novalidate class="needs-validation" method="POST"
        action="{{ route('categorias.update', ['categoria' => $categoria]) }}">
        @csrf
        @method('PUT')
        @include('admin.categoria.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('categorias.show', ['categoria' => $categoria]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>


@endsection
