@extends('layout')
@section('main')
    <!--make two divs in columns, one with the 1/4 size of the right-->
    <div class="container">
        <!-- breadcrumb -->
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg breadcrumbs">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('catalogo.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Catálogo
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            @if(Auth::user()->user_type == 'C')
                <span class="stext-109 cl4">
                    Minhas Imagens
                </span>
            @endif
            @if(Auth::user()->user_type == 'A')
                <span class="stext-109 cl4">
                    Gerir Imagens
                </span>
            @endif
        </div>

        <!-- search e file upload para admins -->
        <div class="row">
            @if(Auth::user()->user_type == 'A')
            <div class="col-sm-3">
                <div class="row">
                    <form method="GET" action="{{ route('catalogo.edit') }}" id="formFiltro">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1 pe-2">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 mb-3 me-2 form-floating">
                                        <select class="form-select" name="categoriaOrder" id="inputOrderCategoria">
                                            <option {{ old('categoriaOrder', $orderByCategoria) === '' ? 'selected' : '' }}
                                                value="">Ordenar por</option>
                                            @foreach ($filteredColumns as $campo)
                                                <option
                                                    {{ old('categoriaOrder', $orderByCategoria) == $campo ? 'selected' : '' }}
                                                    value="{{ $campo }}">{{ $campo }}</option>
                                            @endforeach
                                        </select>
                                        <label for="inputOrderCategoria" class="form-label">Ordenar por</label>

                                    </div>
                                    <div class="flex-grow-1 mb-3 me-2 form-floating">
                                        <select class="form-select" name="categoriaOrderAscDesc" id="inputOrderCategoriaAscDesc">
                                            <option {{ old('categoriaOrderAscDesc', $orderByCategoriaAscDesc) === 'asc' ? 'selected' : '' }} value="asc">Ascendente</option>
                                            <option {{ old('categoriaOrderAscDesc', $orderByCategoriaAscDesc) === 'desc' ? 'selected' : '' }} value="desc">Descendente</option>
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
                            <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1"
                                name="filtrar">Filtrar</button>
                            <a href="{{ route('catalogo.edit') }}"
                                class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('catalogo.uploadEstampa') }}" id="formFiltro"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- {{ csrf_field() }} -->
                        <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                            <input type="file" class="btn btn-secondary mb-3 px-4 flex-grow-1" id="Estampa"
                                name="Estampa" accept=".jpg,.jpeg,.png" onchange="UploadFileSet()">
                            <input type="text" class="hidden inputText" name="NomeEstampa" id="NomeEstampa"
                                min="1" max="20" placeholder="Nome">
                            <input type="text" class="hidden inputText" name="DescricaoEstampa" id="DescricaoEstampa"
                                min="10" max="100" placeholder="Descrição">
                            <input type="text" class="hidden inputText" name="categoriaEstampa" id="categoriaEstampa"
                                min="1" max="3" placeholder="categoria">
                            <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1 hidden" id="uploadFile"
                                name="uploadFile">Submeter Estampa</button>
                        </div>
                    </form>
                </div>

            </div>
            @endif

            <!-- file upload para customers -->
            @if (Auth::user()->user_type == 'C')
                <div class="col-sm-3">
                    <h1 style="color:white;">As Minhas Imagens</h1>
                    <div class="row">
                        <form method="POST" action="{{ route('catalogo.uploadEstampa') }}" id="formFiltro"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- {{ csrf_field() }} -->
                            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                                <input type="file" class="btn btn-secondary mb-3 px-4 flex-grow-1" id="Estampa"
                                    name="Estampa" accept=".jpg,.jpeg,.png" onchange="UploadFileSetC()">
                                <input type="text" class="hidden inputText" name="NomeEstampa" id="NomeEstampa"
                                    min="1" max="20" placeholder="Nome">
                                <input type="text" class="hidden inputText" name="DescricaoEstampa"
                                    id="DescricaoEstampa" min="10" max="100" placeholder="Descrição">
                                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1 hidden"
                                    id="uploadFile" name="uploadFile">Submeter Estampa</button>
                            </div>
                        </form>

                    </div>
                </div>
            @endif

            <!-- listagem de estampas para os 2 com ajustes-->
            <div class="col-sm-9">
                <div class="row background">
                    @foreach ($tshirts as $tshirt)
                        <div class="col-4 imgCardBack noHover">

                            <div class="min-height250">
                                <img src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}" class="card-img-top center"
                                    alt="{{ $tshirt['image_url'] }}">
                                </a>
                            </div>
                            <div>
                                <div class="row">
                                    <div>
                                        <h5 class="card-title titleCardBack">{{ $tshirt['name'] }}
                                            @if(Auth::user()->user_type == 'A')
                                                <br><br><span>Categoria: {{ $tshirt['category_id'] }}</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="row min-height100">
                                    <div>
                                        <p class="card-text textCardBack center">{{ $tshirt['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                                <a class="btn btn-secondary mb-2 px-4 flex-shrink-1" style="visibility: hidden;">ffff</a>
                                @if(Auth::user()->user_type == 'C')
                                <a href="#"
                                    onclick="updateEstampaC('{{ addslashes($tshirt['id']) }}', '{{ addslashes($tshirt['name']) }}', '{{ addslashes($tshirt['description']) }}', '{{ addslashes($tshirt['image_url']) }}')"
                                    class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Editar</a>
                                @else
                                <a href="#"
                                    onclick="updateEstampa('{{ addslashes($tshirt['id']) }}', '{{ addslashes($tshirt['name']) }}', '{{ addslashes($tshirt['description']) }}', '{{ addslashes($tshirt['category_id']) }}', '{{ addslashes($tshirt['image_url']) }}')"
                                    class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Editar</a>
                                @endif
                                <a href="/removerEstampa/{{ $tshirt['id'] }}"
                                    style="background-color: rgb(179, 0, 0); border-color: rgb(179, 0, 0);"
                                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Eliminar</a>
                            </div>
                        </div>
                        <br>
                    @endforeach()
                </div>
                <br>
                @if(Auth::user()->user_type == 'A')
                    <div>
                        {{ $tshirts->withQueryString()->links() }}
                    </div>
                @endif
                <br>
            </div>
            <br>
        </div>
    </div>

    <!-- popup update de estampas para os dois com ajustes -->
    <div class="overlayBackground hidden" id="divOverlay">
        <form method="POST" action="{{ route('catalogo.editarEstampa') }}" id="formEditar"
            enctype="multipart/form-data">
            @csrf
            <!-- {{ csrf_field() }} -->
            <div class="updateBox center">
                <div class="min-height250 center">
                    <img src="" style="max-width: 250px; margin: auto;" class="card-img-top center"
                        id="imgUpdate">
                </div>
                <input type="hidden" class="inputTextUpdate" name="updateIdEstampa" id="updateIdEstampa"
                    value="">
                <label for="updateNomeEstampa" class="labelUpdate">Nome</label>
                <input type="text" class="inputTextUpdate" name="updateNomeEstampa" id="updateNomeEstampa"
                    min="1" max="20" placeholder="Nome" value="">
                <label for="updateDescricaoEstampa" class="labelUpdate">Descrição</label>
                <input type="text" class="inputTextUpdate" name="updateDescricaoEstampa" id="updateDescricaoEstampa"
                    min="10" max="100" placeholder="Descrição" value="">
                @if(Auth::user()->user_type == 'A')
                    <label for="updatecategoriaEstampa" class="labelUpdate">Categoria</label>
                    <input type="text" class="inputTextUpdate" name="updatecategoriaEstampa" id="updatecategoriaEstampa"
                        min="1" max="3" placeholder="Categoria" value="">
                @endif
                <button type="submit" style="margin: auto; width: 20%; height: 10%;"
                    class="btn btn-primary mb-3 px-4 flex-grow-1" id="updateBtn" name="updateBtn">Submeter
                    Edição</button>
                <button type="button" onclick="closeOverlay()" style="margin: auto; width: 20%; height: 10%;"
                    class="btn btn-secondary mb-3 px-4 flex-grow-1" id="updateBtn" name="updateBtn">Cancelar</button>
            </div>
        </form>
    </div>
@endsection
<script>
    function UploadFileSet() {
        var file = document.querySelector('#Estampa');
        var submitBtn = document.querySelector('#uploadFile');
        var NomeEstampa = document.querySelector('#NomeEstampa');
        var DescricaoEstampa = document.querySelector('#DescricaoEstampa');
        var categoria = document.querySelector('#categoriaEstampa');

        if (file.files[0].name != null) {
            submitBtn.classList.remove('hidden');
            NomeEstampa.classList.remove('hidden');
            DescricaoEstampa.classList.remove('hidden');
            categoria.classList.remove('hidden');
        } else {
            submitBtn.classList.add('hidden');
            NomeEstampa.classList.add('hidden');
            DescricaoEstampa.classList.add('hidden');
            categoria.classList.add('hidden');
        }
    }

    function UploadFileSetC() {
        var file = document.querySelector('#Estampa');
        var submitBtn = document.querySelector('#uploadFile');
        var NomeEstampa = document.querySelector('#NomeEstampa');
        var DescricaoEstampa = document.querySelector('#DescricaoEstampa');

        if (file.files[0].name != null) {
            submitBtn.classList.remove('hidden');
            NomeEstampa.classList.remove('hidden');
            DescricaoEstampa.classList.remove('hidden');
        } else {
            submitBtn.classList.add('hidden');
            NomeEstampa.classList.add('hidden');
            DescricaoEstampa.classList.add('hidden');
        }
    }

    function updateEstampa($id, $nome, $descricao, $categoria, $image) {
        var id = document.querySelector('#updateIdEstampa');
        var nome = document.querySelector('#updateNomeEstampa');
        var descricao = document.querySelector('#updateDescricaoEstampa');
        var categoria = document.querySelector('#updatecategoriaEstampa');
        var divOverlay = document.querySelector('#divOverlay');
        var img = document.querySelector('#imgUpdate');

        id.value = $id;
        nome.value = $nome;
        descricao.value = $descricao;
        categoria.value = $categoria;
        img.src = "tshirt_images/" + $image;

        divOverlay.classList.remove('hidden');
    }

    function updateEstampaC($id, $nome, $descricao, $image) {
        var id = document.querySelector('#updateIdEstampa');
        var nome = document.querySelector('#updateNomeEstampa');
        var descricao = document.querySelector('#updateDescricaoEstampa');
        var divOverlay = document.querySelector('#divOverlay');
        var img = document.querySelector('#imgUpdate');

        id.value = $id;
        nome.value = $nome;
        descricao.value = $descricao;
        img.src = "tshirt_images/" + $image;

        divOverlay.classList.remove('hidden');
    }

    function closeOverlay() {
        var divOverlay = document.querySelector('#divOverlay');

        divOverlay.classList.add('hidden');
    }
</script>
</body>

</html>
