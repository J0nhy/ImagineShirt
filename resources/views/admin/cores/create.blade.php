@extends('adminLayout')
@section('main')
    <form method="POST" action="{{ route('cores.store') }}"enctype="multipart/form-data">
        @csrf
        <!-- {{ csrf_field() }} -->
        @include('admin.cores.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar nova cor</button>
        </div>
    </form>

@endsection
