@extends('adminLayout')

@section('main')
    <div>
        @include('admin.encomendas.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">

        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#confirmationModal"
            data-msgLine1="Quer realmente apagar o curso <strong>&quot;{{ $encomenda->status }}&quot;</strong>?"
            data-action="">
            Apagar Cor
        </button>
        <a href="" class="btn btn-secondary ms-3">Alterar Cor</a>
    </div>


@endsection
