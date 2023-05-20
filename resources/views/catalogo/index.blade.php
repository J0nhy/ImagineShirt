@extends('layout')
@section('main')
<div class="container">
    
    {{--inicio da Zona de testes para o carrinho--}}
    @if(session('message'))
        <script>
            alert('{{ session('message') }}');
        </script>
    @endif
    {{--fim da Zona de testes para o carrinho--}}

    <div class="row">
        @foreach($tshirt_images as $tshirt)
        @if($loop->iteration == 20
    )
            @break
        @endif
        <div class="col-md-2 imgCardBack">

            <div class="min-height">
                <a href="detail_{{$tshirt}}.php?id={{$tshirt['id']}}">
                    <img src="tshirt_images/{{$tshirt['image_url']}}" class="card-img-top center" alt="{{$tshirt['image_url']}}">
                </a>
            </div>
                <div class="card-body">
                    <div class="row">
                    <div >
                        <h5 class="card-title titleCardBack">{{$tshirt['name']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <p class="card-text textCardBack center">{{$tshirt['description']}}</p>
                     </div>
                </div>
                <a href="/addToCart/{{$tshirt['image_url']}}">addToCart</a>
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
