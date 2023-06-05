@extends('layout')
@section('main')
    {{-- inicio da Zona de testes para o carrinho --}}
    @if (session('message'))
        <script>
            alert('{{ session('message') }}');
        </script>
    @endif
    {{-- fim da Zona de testes para o carrinho --}}

    <section class="sec-product-detail bg0 background">

        <div class="container bg0 p-t-65 background">
            <div class="row customShirtBack">

                <div class="col-md-6 myBlowAnim position-relative">

                    <!--put one image that occopy the whole div and center it-->
                    <img id="baseTshirt" src="/tshirt_base/{{ $allColors['0']['code'] }}.png" alt="IMG-PRODUCT"
                        style="width: 80%; height: 80%; max-height: none;object-fit: contain; position:absolute; z-index: 1;">
                    <div
                        style="height: 250px;
                    width: 200px;  position:absolute; z-index: 3; top: 40%; left: 45%; transform: translate(-52%,-50%);">

                        <img id="fotoTshirt"src="/tshirt_images/{{ $tshirt->image_url }}" alt="IMG-PRODUCT"
                            style="object-fit: cover; max-width:160px; max-height:350px;">
                    </div>


                </div>

                <div class="col-md-6 col-lg-5 p-b-30 ">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14 titleCardBack">
                            {{ $tshirt->name }}
                        </h4>

                        <span class="mtext-106 cl2 titleCardBack">
                            15€
                        </span>

                        <p class="stext-102 cl3 p-t-23 textCardBack">
                            {{ $tshirt->description }}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="dropdown" style="float: left;">
                                <div class="select">
                                    <span>Tamanho <i class="zmdi zmdi-chevron-down icon"
                                            style="vertical-align: middle;"></i></span>
                                    <i class="fa fa-chevron-left"></i>
                                </div>
                                <input type="hidden" name="size">
                                <ul class="dropdown-menu">
                                    <li onclick="changeSize('S')" id="S">S</li>
                                    <li onclick="changeSize('M')"id="M">M</li>
                                    <li onclick="changeSize('L')"id="L">L</li>
                                    <li onclick="changeSize('XL')"id="XL">XL</li>
                                </ul>
                            </div>
                        </div>
                        <br><br><br>

                        <div>

                            @foreach ($allColors as $cor)
                                <button title="{{ $cor->name }}" class="color"
                                    style="background-color: #<?php echo $cor['code']; ?> "
                                    onclick="changeImage('<?= $cor['code'] ?>', '<?= $cor['name'] ?>')">
                                </button>
                            @endforeach()

                        </div>
                        <br>
                        <div class="flex-w flex-c-str p-b-10">
                            <div class=" flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w  m-r-20 m-tb-10">
                                    <div onclick="changeQty('-')"
                                        class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input disabled class="mtext-104 cl3 txt-center num-product" type="number"
                                        id="qty" name="num-product1" value="1" min="1" max="50">

                                    <div onclick="changeQty('+')" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                                <button
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    <a id="addCart" href="#" class="linkBranco">Adicionar ao Carrinho</a>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------ É PARA USAR ISTO ???????? -------------------------------
                <div class="bor10 m-t-50 p-t-43 p-b-40">
                    <!-- Tab01
                    <div class="tab01">
                        <!-- Nav tabs
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item p-b-10">
                                <a class="nav-link active" data-toggle="tab" href="#description"
                                    role="tab">Description</a>
                            </li>

                            <li class="nav-item p-b-10">
                                <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional
                                    information</a>
                            </li>

                            <li class="nav-item p-b-10">
                                <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
                            </li>
                        </ul>

                        <!-- Tab panes
                        <div class="tab-content p-t-43">

                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="how-pos2 p-lr-15-md">
                                    <p class="stext-102 cl6">
                                        {{ $tshirt->description }} </p>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="information" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                        <ul class="p-lr-28 p-lr-15-sm">
                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Weight
                                                </span>

                                                <span class="stext-102 cl6 size-206">
                                                    0.79 kg
                                                </span>
                                            </li>

                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Dimensions
                                                </span>

                                                <span class="stext-102 cl6 size-206">
                                                    110 x 33 x 100 cm
                                                </span>
                                            </li>

                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Materials
                                                </span>

                                                <span class="stext-102 cl6 size-206">
                                                    60% cotton
                                                </span>
                                            </li>

                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Color
                                                </span>

                                                <span class="stext-102 cl6 size-206">
                                                    Black, Blue, Grey, Green, Red, White
                                                </span>
                                            </li>

                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Size
                                                </span>

                                                <span class="stext-102 cl6 size-206">
                                                    XL, L, M, S
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                        <div class="p-b-30 m-lr-15-sm">
                                            <!-- Review
                                            <div class="flex-w flex-t p-b-68">
                                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                    <img src="images/avatar-01.jpg" alt="AVATAR">
                                                </div>

                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m p-b-17">
                                                        <span class="mtext-107 cl2 p-r-20">
                                                            Ariana Grande
                                                        </span>

                                                        <span class="fs-18 cl11">
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star-half"></i>
                                                        </span>
                                                    </div>

                                                    <p class="stext-102 cl6">
                                                        Quod autem in homine praestantissimum atque optimum est, id deseruit.
                                                        Apud ceteros autem philosophos
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Add review
                                            <form class="w-full">
                                                <h5 class="mtext-108 cl2 p-b-7">
                                                    Add a review
                                                </h5>

                                                <p class="stext-102 cl6">
                                                    Your email address will not be published. Required fields are marked *
                                                </p>

                                                <div class="flex-w flex-m p-t-50 p-b-23">
                                                    <span class="stext-102 cl3 m-r-16">
                                                        Your Rating
                                                    </span>

                                                    <span class="wrap-rating fs-18 cl11 pointer">
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                        <input class="dis-none" type="number" name="rating">
                                                    </span>
                                                </div>

                                                <div class="row p-b-25">
                                                    <div class="col-12 p-b-5">
                                                        <label class="stext-102 cl3" for="review">Your review</label>
                                                        <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                    </div>

                                                    <div class="col-sm-6 p-b-5">
                                                        <label class="stext-102 cl3" for="name">Name</label>
                                                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                            type="text" name="name">
                                                    </div>

                                                    <div class="col-sm-6 p-b-5">
                                                        <label class="stext-102 cl3" for="email">Email</label>
                                                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                            type="text" name="email">
                                                    </div>
                                                </div>

                                                <button
                                                    class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
                <span class="stext-107 cl6 p-lr-25">
                    SKU: JAK-01
                </span>

                <span class="stext-107 cl6 p-lr-25">
                    Categories: Jacket, Men
                </span>
            </div>
        -->
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        var image = document.querySelector('#baseTshirt');
        var size = document.querySelector('#addCart');
        var tamanho = "M";
        var cor = "Azul marinho";
        var qtd = 1;


        function changeImage(colorCode, colorName) {
            image.src = '/tshirt_base/' + colorCode + '.png';
            cor = colorName;
            changeURL();
        }



        function changeSize($val) {
            tamanho = $val;
            changeURL();
        }

        function changeQtd() {
            qtd = document.querySelector('#qty').value;
            changeURL();
        }

        function changeURL() {
            size.href = "/addToCart/{{ $tshirt->image_url }}/{{ $tshirt->name }}/" + cor + "/" + tamanho + "/" + qtd;
        }

        function changeQty($op) {
            var qty = document.querySelector('#qty');
            if ($op == "-") {
                if (qty.value > 1) {
                    qty.value--;
                }
            } else {
                if (qty.value < 50) {
                    qty.value++;
                }
            }
            changeQtd();
        }

        /*Dropdown Menu*/
        $('.dropdown').click(function() {
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.dropdown-menu').slideToggle(300);
        });
        $('.dropdown').focusout(function() {
            $(this).removeClass('active');
            $(this).find('.dropdown-menu').slideUp(300);
        });
        $('.dropdown .dropdown-menu li').click(function() {
            $(this).parents('.dropdown').find('span').text($(this).text());
            $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
        });
        /*End Dropdown Menu*/
    </script>
@endsection
