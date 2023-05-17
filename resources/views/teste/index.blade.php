@extends('layout')
@section('header-title', 'Lista de tshirts')
@section('main')

<div class="container">

    <div class="row">
        @foreach($Tshirt_images as $tshirt)
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        @if($loop->iteration == 19)
            @break
        @endif
        <div class="col-md-2">
            <div class="card" style="height: 10px;">
                <a href="detail_{{$tshirt}}.php?id={{$tshirt['id']}}">
                    <img src="/tshirt_images/{{$tshirt['image_url']}}" class="card-img-top" alt="{{$tshirt['image_url']}}">

                </a>

                <div class="card-body">
                    <div class="row">
                        <div >
                            <h5 class="card-title">{{$tshirt['name']}}</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div >
                            <p class="card-text">{{$tshirt['description']}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <br><br><br><br><br><br><br>

        @endforeach()

    </div>
</div>
@endsection

</body>
</html>
