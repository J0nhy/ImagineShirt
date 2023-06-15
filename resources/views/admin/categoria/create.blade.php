@extends('adminLayout')
@section('main')
    <form method="POST" action="{{ route('categorias.store') }}">
        @csrf
@method('POST')
        @include('admin.categoria.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar nova categoria</button>
            <a href="{{ route('categorias.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
