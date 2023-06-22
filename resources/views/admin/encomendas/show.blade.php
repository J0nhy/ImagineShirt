
@extends('adminLayout')
@section('main')
    <div>
        @include('admin.encomendas.shared.fields', ['readonlyData' => true])
    </div>

@endsection
