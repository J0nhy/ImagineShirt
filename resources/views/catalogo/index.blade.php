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

    <div class="row">
        @foreach($tshirt_images as $tshirt)
        @if($loop->iteration == 20)
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
    <div >
        {{ $tshirt_images->links() }}
    </div>

</div>

@endsection

</body>

</html>
