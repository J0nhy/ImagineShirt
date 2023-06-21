@extends('adminLayout')

@section('main')
    <div>
        @include('admin.user.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-3 d-flex justify-content-end" style="padding-right:135px">

        <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" name="delete" class="btn btn-danger">

            Apagar User</button>
        </form>
        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-secondary ms-3">Alterar User</a>
    </div>



@endsection
