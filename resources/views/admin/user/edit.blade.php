@can('update', $user )
@extends('adminLayout')

@section('main')
    <form novalidate class="needs-validation" method="POST"
        action="{{ route('users.update', ['user' => $user]) }}">
        @csrf
        @method('PUT')
        @include('admin.user.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('users.show', ['user' => $user]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>


@endsection
@endcan
