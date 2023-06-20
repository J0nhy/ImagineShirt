@extends('adminLayout')

@section('main')
    <div>
        @include('admin.cores.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">

        <form method="POST" action="{{ route('cores.destroy', ['core' => $cor->code]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger">

            Apagar Cor</button>
        </form>
    </div>



@endsection
