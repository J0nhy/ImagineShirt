@can('viewAny', \App\Models\orders::class)
@extends('adminLayout')
@section('main')
    <section class="section dashboard">
        <h1>Encomendas</h1>
        <form method="GET" action="{{ route('encomendas.index') }}" id="">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 me-2 form-floating">
                        <select class="form-select" name="status" id="inputType">
                            <option {{ old('allOrders', $allOrders) === '' ? 'selected' : '' }}
                                value="">Todos os tipos </option>
                                @foreach ($allOrders->unique('status')->pluck('status') as $order)
                                <option
                                    {{ old('order', $filterByStatus) == $order ? 'selected' : '' }}
                                    value="{{ $order }}">{{ $order }}</option>
                            @endforeach
                        </select>
                        <label for="inputCategoria" class="form-label">Tipo</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="CostumerID" id="inputCostumerID"
                            value="{{ old('CostumerID', $filterByCostumerID) }}">
                        <label for="inputCostumerID" class="form-label">CostumerID</label>
                    </div>
                </div>

            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <a class="btn btn-secondary mb-2 px-4 flex-shrink-1" style="visibility: hidden;">ffff</a>
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1"
                    name="filtrar">Filtrar</button>
                <a href="{{ route('encomendas.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
            </form>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Status</th>
                    <th>Costumer ID</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th>Notes</th>

                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($encomendas as $encomenda)
                    <tr>
                        <td>{{ $encomenda->status }}</td>
                        <td>{{ $encomenda->customer_id }}</td>
                        <td>{{ $encomenda->date }}</td>
                        <td>{{ $encomenda->total_price }}</td>
                        <td>{{ $encomenda->notes }}</td>

                        <td class="button-icon-col">

                            <a class="btn btn-secondary" href="{{ route('encomendas.show', ['encomenda' => $encomenda]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                  </svg>
                            </a>
                        </td>

                        @if($encomenda->status == 'pending')


                            <td class="button-icon-col">

                                <form method="POST" action="{{ route('encomendas.paid', ['encomenda' => $encomenda]) }}">
                                    @csrf

                                    @method('PUT')
                                    <button type="submit" name="recover" class="btn btn-success" title="closed">

                                            Confirmar pagamento
                                    </button>

                                </form>

                            </td>
                        @elseif ($encomenda->status == 'paid')

                            <td class="button-icon-col">


                                    <form method="POST" action="{{ route('encomendas.closed', ['encomenda' => $encomenda]) }}">
                                        @csrf

                                        @method('PUT')
                                        <button type="submit" name="recover" class="btn btn-danger" title="closed">

                                                Fechar
                                        </button>

                                    </form>

                            </td>
                            @elseif ($encomenda->status == 'canceled')
                            <td></td>

                            @else

                            <td class="button-icon-col">

                                <form method="POST" action="{{ route('encomendas.canceled', ['encomenda' => $encomenda]) }}">
                                    @csrf

                                    @method('PUT')
                                    <button type="submit" name="recover" class="btn btn-danger" title="closed">
                                            Cancelar
                                    </button>

                                </form>

                        </td>
                        @endif


                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $encomendas->withQueryString()->links() }}
        </div>
    </section>
@endsection
@endcan

