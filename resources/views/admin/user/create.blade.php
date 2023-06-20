@extends('adminLayout')
@section('main')
    <form method="POST" action="{{ route('users.store') }}"enctype="multipart/form-data">
        @csrf
        <!-- {{ csrf_field() }} -->
        @include('admin.user.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar novo user</button>
        </div>
    </form>

@endsection
