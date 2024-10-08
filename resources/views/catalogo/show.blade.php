@extends('layout')
@section('main')
<div class="container">

    <!-- breadcrumb -->
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg breadcrumbs" style="margin-bottom: 0%">
        <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="{{ route('catalogo.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
            Catálogo
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Personalizar
        </span>
    </div>

        <div class="container bg0 p-t-65 background">
            <div class="row customShirtBack">

                <div class="col-md-6 myBlowAnim position-relative" onclick="expandirImagem('#fotoTshirt')">

                    <!--put one image that occopy the whole div and center it-->
                    <img id="baseTshirt" src="/storage/tshirt_base/{{ $allColors['0']['code'] }}.png" alt="IMG-PRODUCT"

                        style="width: 80%; height: 80%; max-height: none;object-fit: contain; position:absolute; z-index: 1;">
                    <div
                        style="height: 250px;
                    width: 200px;  position:absolute; z-index: 3; top: 40%; left: 46%; transform: translate(-52%,-50%);">

                        <img id="fotoTshirt"src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}" alt="IMG-PRODUCT"
                            style="object-fit: cover; max-width:160px; max-height:350px;">
                    </div>


                </div>
                <!-- Pop-up -->
                <div class="popup" onclick="fecharPopUp()">
                    <div class="popup-content">
                        <img class="popup-image" src="" alt="Imagem expandida">
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30 ">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14 titleCardBack">
                            {{ $tshirt->name }}
                        </h4>

                        <span class="mtext-106 cl2 titleCardBack">
                            <?= empty($tshirt->customer_id) ? '10' : '15' ?>€
                        </span>

                        <p class="stext-102 cl3 p-t-23 textCardBack">
                            {{ $tshirt->description }}
                        </p>

                        <!-- Dropdown -->
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
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        var image = document.querySelector('#baseTshirt');
        var size = document.querySelector('#addCart');
        var tamanho = "M";
        var cor = "Azul marinho";
        var corCode = "00a2f2";
        var qtd = 1;


        function changeImage(colorCode, colorName) {
            image.src = '/storage/tshirt_base/' + colorCode + '.png';
            cor = colorName;
            corCode = colorCode;
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
            size.href = "/addToCart/{{ $tshirt->id }}/{{ $tshirt->image_url }}/{{ $tshirt->name }}/" + cor + "/" +
                tamanho + "/" + qtd + "/" + corCode + "/{{ $tshirt->customer_id != null ? 'True' : 'False' }}";
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

        /* espandir a imagem da tshirt */
        function expandirImagem(img) {
            var imagem = document.querySelector(img);
            var popup = document.querySelector('.popup');
            var popupImage = document.querySelector('.popup-image');

            // Define a imagem expandida
            popupImage.src = imagem.src;

            // Exibe o pop-up
            popup.style.display = 'flex';
        }

        function fecharPopUp() {
            var popup = document.querySelector('.popup');
            popup.style.display = 'none';
        }
    </script>
@endsection
