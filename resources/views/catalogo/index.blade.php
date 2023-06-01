@extends('layout')
@section('main')
<div class="container Margintp5">

    {{--inicio da Zona de testes para o carrinho--}}
    @if(session('message'))
        <script>
            alert('{{ session('message') }}');
        </script>
    @endif
    {{--fim da Zona de testes para o carrinho--}}

    <!--make two divs in columns, one with the 1/4 size of the right-->
    <div class="row">
    <div class="col-sm-3">
        <div class="row">
            <form method="GET" action="{{ route('catalogo.index') }}" id="formFiltro">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 pe-2">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 mb-3 me-2 form-floating">
                                <select class="form-select" name="categoriaOrder" id="inputOrderCategoria">
                                    <option {{ old('categoriaOrder', $orderByCategoria) === '' ? 'selected' : '' }}
                                        value="">Ordenar por</option>
                                    @foreach ($table_names as $campo)
                                        <option
                                        {{ old('categoriaOrder', $orderByCategoria) == $campo ? 'selected' : '' }}
                                        value="{{ $campo }}">{{ $campo }}</option>
                                    @endforeach
                                </select>
                                <label for="inputOrderCategoria" class="form-label">Ordenar por</label>

                            </div>
                            <div class="flex-grow-1 mb-3 me-2 form-floating">
                                <select class="form-select" name="categoriaOrderAscDesc" id="inputOrderCategoriaAscDesc">
                                    <option {{ old('categoriaOrderAscDesc', $orderByCategoriaAscDesc) === '' ? 'selected' : '' }}
                                        value="asc">Ascendente</option>
                                    <option {{ old('categoriaOrderAscDesc', $orderByCategoriaAscDesc) === '' ? 'selected' : '' }}
                                        value="desc">Descendente</option>

                                </select>
                                <label for="inputOrderCategoriaAscDesc" class="form-label">Ordem</label>

                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 mb-3 me-2 form-floating">
                                <select class="form-select" name="categoria" id="inputCategoria">
                                    <option {{ old('categoria', $filterByCategoria) === '' ? 'selected' : '' }}
                                        value="">Todas as categorias </option>
                                    @foreach ($categorias as $categoria)
                                        <option
                                            {{ old('categoria', $filterByCategoria) == $categoria->id ? 'selected' : '' }}
                                            value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    @endforeach
                                </select>
                                <label for="inputCategoria" class="form-label">Categoria</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="mb-3 me-2 flex-grow-1 form-floating">
                                <input type="text" class="form-control" name="nome" id="inputNome"
                                    value="{{ old('nome', $filterByNome) }}">
                                <label for="inputNome" class="form-label">Nome</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="mb-3 me-2 flex-grow-1 form-floating">
                                <input type="text" class="form-control" name="descricao" id="inputDescricao"
                                    value="{{ old('descricao', $filterByDescricao) }}">
                                <label for="inputDescricao" class="form-label">Descricao</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                    <a class="btn btn-secondary mb-2 px-4 flex-shrink-1" style="visibility: hidden;">ffff</a>
                    <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                    <a href="{{ route('catalogo.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
                </div>
            </form>
        </div>

    </div>
    <div class="col-sm-9">
        <div class="row">
            @foreach($tshirts as $tshirt)
            @if($loop->iteration >=count($tshirts)+1)
                @break
            @endif
            <div class="col-4 imgCardBack">

                <div class="min-height250">
                    <a href="{{ route('catalogo.show', ['tshirt' => $tshirt]) }}">
                        <img src="tshirt_images/{{$tshirt['image_url']}}" class="card-img-top center" alt="{{$tshirt['image_url']}}">
                    </a>
                </div>
                    <div class="card-body">
                        <div class="row">
                        <div >
                            <h5 class="card-title titleCardBack">{{$tshirt['name']}}</h5>
                        </div>
                    </div>
                    <div class="row min-height100">
                        <div>
                            <p class="card-text textCardBack center">{{$tshirt['description']}}</p>
                         </div>
                    </div>
                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer buttonCards">
                        <a href="{{ route('catalogo.show', ['tshirt' => $tshirt]) }}" class="buttonCards" style="text-decoration: none;">Personalizar <i class="zmdi zmdi-chevron-right icon"></i></a>
                    </button>
                </div>
            </div>
            <br>

            @endforeach()

        </div>
        <br>
        <div>
            {{ $tshirts->withQueryString()->links() }}
        </div>
        <br>

    </div>
    </div>




</div>

@endsection

</body>

</html>
