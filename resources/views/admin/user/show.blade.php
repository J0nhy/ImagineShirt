@can('view', $user )

@extends('adminLayout')
@section('main')

    <div>
        @include('admin.user.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-3 d-flex justify-content-end" style="padding-right:135px">
        <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-secondary ms-3">Alterar User</a>
    </div>



@endsection
@endcan
