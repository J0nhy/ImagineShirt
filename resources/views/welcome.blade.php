@extends('layout')
@section('main')
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


    <!-- Banner -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="/banners/banner-04.jpg" alt="IMG-BANNER">

                        <a href="product.html"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Women
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Spring 2018
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="/banners/banner-05.jpg" alt="IMG-BANNER">

                        <a href="product.html"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Men
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Spring 2018
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="/banners/banner-09.jpg" alt="IMG-BANNER">

                        <a href="product.html"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Accessories
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    New Trend
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    <script></script>

    </body>


    </html>
