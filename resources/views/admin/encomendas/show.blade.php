
@extends('adminLayout')
@section('main')
    <div>
        @include('admin.encomendas.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">

        <form method="POST" action="{{ route('encomendas.destroy', ['encomenda' => $encomenda]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger">

            Apagar Encomenda</button>
        </form>
    </div>
@endsection
