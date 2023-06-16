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
            <form method="POST" action="{{ route('catalogo.uploadEstampa') }}" id="formFiltro" enctype="multipart/form-data">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                    <input type="file" class="btn btn-secondary mb-3 px-4 flex-grow-1" id="Estampa" name="Estampa" accept=".jpg,.jpeg,.png" onchange="UploadFileSet()">
                    <input type="text" class="hidden inputText" name="NomeEstampa" id="NomeEstampa" min="1" max="20" placeholder="Nome">
                    <input type="text" class="hidden inputText" name="DescricaoEstampa" id="DescricaoEstampa" min="10" max="100" placeholder="Descrição">
                    <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1 hidden" id="uploadFile" name="uploadFile">Submeter Estampa</button>
                </div>
            </form>
        </div>

    </div>
    <div class="col-sm-9">
        <div class="row background">
            <div style="text-align: right;">
                <h3 style="cursor: pointer; display: inline;" class="marginr5 hoverEffect" onclick="expandirOuRecolher()">As Minhas Imagens 
                    <i class="zmdi zmdi-caret-down icon" style="height: 85%;"> </i>
                </h3>
                <h3 style="display: inline; cursor: default;" >| 
                    <a style="text-decoration: none; color: #444444;" href="{{ route('catalogo.edit') }}">
                        <i class="zmdi zmdi-edit hoverEffect" style="cursor: pointer;"></i>
                    </a>
                </h3>
            </div>
            <hr>
            <br>
            <div class="expansivel background" id="minhaDiv">
                <div class="ver-mais background">
                    @foreach($imagensPrivadas as $tshirt)
                    @if($loop->iteration >= count($tshirts)+1)
                        @break
                    @endif
                    <div class="col-4 imgCardBack">

                    <div class="min-height250">
                        <a href="{{ route('catalogo.show', ['tshirt' => $tshirt->slug]) }}">
                            <img src="tshirt_images/{{$tshirt['image_url']}}" class="card-img-top center" alt="{{$tshirt['image_url']}}">
                        </a>
                    </div>
                        <div>
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
            </div>
            <br>
            @foreach($tshirts as $tshirt)
            @if($loop->iteration >=count($tshirts)+1)
                @break
            @endif
            <div class="col-4 imgCardBack">

                <div class="min-height250">
                    <a href="{{ route('catalogo.show', ['tshirt' => $tshirt->slug]) }}">
                        <img src="tshirt_images/{{$tshirt['image_url']}}" class="card-img-top center" alt="{{$tshirt['image_url']}}">
                    </a>
                </div>
                    <div>
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
<script>
    function UploadFileSet(){
        var file = document.querySelector('#Estampa');
        var submitBtn = document.querySelector('#uploadFile');
        var NomeEstampa = document.querySelector('#NomeEstampa');
        var DescricaoEstampa = document.querySelector('#DescricaoEstampa');

        if(file.files[0].name != null){
            submitBtn.classList.remove('hidden');
            NomeEstampa.classList.remove('hidden');
            DescricaoEstampa.classList.remove('hidden');
        }else{
            submitBtn.classList.add('hidden');
            NomeEstampa.classList.add('hidden');
            DescricaoEstampa.classList.add('hidden');
        }
    }
    function expandirOuRecolher() {
      var div = document.getElementById("minhaDiv");
      div.classList.toggle("expandir");
    }   
</script>
</body>

</html>
