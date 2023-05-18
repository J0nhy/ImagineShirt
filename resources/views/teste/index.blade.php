@extends('layout')
@section('header-title', 'Lista de tshirts')
@section('main')
<div class="container">

    <div class="row">
        @foreach($Tshirt_images as $tshirt)
        @if($loop->iteration == 6
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
            </div>
        </div>
        <br>

        @endforeach()
    </div>
</div>
@endsection

</body>
</html>
