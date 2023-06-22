@extends('layout')
@section('main')
<div style="width: 100%; padding: 0%; margin: 0%;">
    <section class="carousel" aria-label="Gallery">
        <ol class="carousel__viewport">
            <li id="carousel__slide1" tabindex="0" class="carousel__slide">
                <div class="carousel__snapper">
                    <a href="#carousel__slide4" class="carousel__prev">Go to last slide</a>
                    <a href="#carousel__slide2" class="carousel__next">Go to next slide</a>
                </div>
            </li>
            <li id="carousel__slide2" tabindex="0" class="carousel__slide">
                <div class="carousel__snapper"></div>
                <a href="#carousel__slide1" class="carousel__prev">Go to previous slide</a>
                <a href="#carousel__slide3" class="carousel__next">Go to next slide</a>
            </li>
            <li id="carousel__slide3" tabindex="0" class="carousel__slide">
                <div class="carousel__snapper"></div>
                <a href="#carousel__slide2" class="carousel__prev">Go to previous slide</a>
                <a href="#carousel__slide4" class="carousel__next">Go to next slide</a>
            </li>
            <li id="carousel__slide4" tabindex="0" class="carousel__slide">
                <div class="carousel__snapper"></div>
                <a href="#carousel__slide3" class="carousel__prev">Go to previous slide</a>
                <a href="#carousel__slide1" class="carousel__next">Go to first slide</a>
            </li>
        </ol>
    </section>
    <h3 class="center linkBranco" style="margin-top: -20%;">Projeto Desenvolvido no âmbito de Aplicações para a Internet</h3><br>
    <h4 class="center" style="color: rgb(175, 0, 0)">Developers:  
        <span class="textCardBack">João Lopes | </span>
        <span class="textCardBack">João Custódio | </span>
        <span class="textCardBack">Diogo Leonardo</span>
    </h4>
</div>
    </body>
    </html>
@endsection