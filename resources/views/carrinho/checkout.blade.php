	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script>
        function showFields(){
            var divFields = document.querySelector('#fields');
            var divExisting = document.querySelector('#existingAddress');
            var divNew = document.querySelector('#newAddress');
            var paymentObj = document.querySelector('#payment');
            var paymentTxt = document.querySelector('#paymentTxt');

            var nome = document.querySelector('#Nome');
            var nif = document.querySelector('#NIF');
            var morada = document.querySelector('#Morada');
            var cod = document.querySelector('#cod');
            var localidade = document.querySelector('#Localidade');
            var descricao = document.querySelector('#Descricao');

            divFields.classList.remove('hidden');
            divNew.classList.add('boxSelected');
            divExisting.classList.remove('boxSelected');

            nome.value = '';
            nif.value = '';
            morada.value = '';
            cod.value = '';
            localidade.value = '';
            descricao.value = '';
            paymentObj.value = "";
            paymentTxt.innerHTML = "Pagamento <i class='zmdi zmdi-chevron-down icon' style='vertical-align: middle;'></i>";

            var btnSubmit = document.querySelector('#btnSubmit');

            Payment = "";
            btnSubmit.type = "button"

        }
        function hideFields(){
            var divFields = document.querySelector('#fields');
            var divExisting = document.querySelector('#existingAddress');
            var divNew = document.querySelector('#newAddress');
            var paymentObj = document.querySelector('#payment');
            var paymentTxt = document.querySelector('#paymentTxt');

            var nome = document.querySelector('#Nome');
            var nif = document.querySelector('#NIF');
            var morada = document.querySelector('#Morada');
            var descricao = document.querySelector('#Descricao');

            divFields.classList.add('hidden');
            divExisting.classList.add('boxSelected');
            divNew.classList.remove('boxSelected');

            nome.value = "{{ Auth::user()->name }}";
            nif.value = "{{ $customer->nif ?? ''}}";
            morada.value = "{{ $customer->address ?? ''}}";
            descricao.value = "{{ $customer->descricao ?? ''}}";
            paymentObj.value = "{{ $customer->default_payment_type ?? ''}}";
            paymentTxt.innerHTML = "{{$customer->default_payment_type ?? ''}} <i class='zmdi zmdi-chevron-down icon' style='vertical-align: middle;'></i>";

            var btnSubmit = document.querySelector('#btnSubmit');

            Payment = "{{ $customer->default_payment_type ?? ''}}}";
            btnSubmit.type = "submit"
        }
    </script>

    @extends('layout')
    @section('main')
    @if (session('message'))
    <script>
        alert('{{ session('message') }}');
    </script>
    @endif
    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>

<div class="checkout-container">
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="cart" class="stext-109 cl8 hov-cl1 trans-04">
                Shopping Cart
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Checkout
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <form class="bg0 p-t-75 p-b-85 background" method="POST" action="store" style="padding-bottom: 0%;" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="container">
            <div class="row">
                <h4 class="mtext-109 cl2 p-b-30 linkBranco">
                    Selecionar os dados de envio:
                </h4>
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="table-shopping-cart">
                            @if($customer->address != null)

                            <div id="existingAddress" onclick="hideFields()" class="customShirtBack width44 Padding5 myBlowAnim marginb5 dis-inline-block marginr5 size-304">
                                <h5 class="linkBranco">Cliente: {{ Auth::user()->name }}</h5>
                                <h5 class="linkBranco">Nif: {{ $customer->nif }}</h5>
                                <h5 class="linkBranco">Morada: {{ $customer->address }}</h5>
                                <h5 class="linkBranco">Forma de Pagamento: {{ $customer->default_payment_type }}</h5>
                            </div>
                            <div id="newAddress" onclick="showFields()" style="vertical-align: top" class="customShirtBack width44 Padding5 myBlowAnim marginb5 dis-inline-block size-304">
                                <h5 class="linkBranco">Criar uma nova morada para esta encomenda</h5>
                            </div>
                            @endif
                            <div id="fields" class="<?php  $customer->address != null ? 'hidden' : ''; ?>">
                                <input type="text" class="inputText width44 dis-inline marginr5" name="Nome" id="Nome" min="1"
                                max="20" placeholder="Nome Completo" required>
                                <input type="text" class="inputText width30 dis-inline marginb8" name="NIF" id="NIF" min="1"
                                max="9" placeholder="NIF">
                                <input type="text" class="inputText width80" name="Morada" id="Morada"
                                min="10" max="100" placeholder="Morada" required>
                                <input type="text" class="inputText width30 dis-inline marginr5" name="cod" id="cod"
                                min="8" max="8" placeholder="Codigo Postal">
                                <input type="text" class="inputText width44 dis-inline marginb8" name="Localidade" id="Localidade"
                                min="10" max="40" placeholder="Localidade">
                                <input type="text" class="inputText width80" name="Descricao" id="Descricao"
                                min="1" max="200" placeholder="Observações">
                                <input class="dis-inline" style="transform : scale(1.5); cursor: pointer;" type="checkbox" name="saveData" id="saveData"><h5 class="dis-inline linkBranco"> Definir estes dados como principais </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="flex-w flex-sb-m p-t-18 p-b-15 p-lr-40 p-lr-15-sm" id="coupon">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

                                <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Apply coupon
                                </div>
                            </div>

                        </div>
                        <div id="checkout" class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Cart Totals
                            </h4>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Total a pagar:
                                    </span>
                                    <input type="hidden" id="valSomaTotal" name="total" value="<?= $total; ?>">
                                </div>

                                <div class="size-219 p-t-1">
                                    <span id="valorTotal" class="mtext-110 cl2">
                                        <?= $total; ?>.00€
                                    </span>
                                </div>

                                <div class="p-t-33 size-210 dis-inline">
                                    <span class="mtext-101 cl2 dis-inline">
                                        A pagar com:
                                    </span>
                                </div>

                                <!-- Dropdown -->
                                <div class="p-t-33 width44 dis-inline">
                                    <div class="dropdown dis-inline" style="float: left;">
                                        <div class="select">
                                            <span style="color:black !important;" id="paymentTxt">Pagamento <i class="zmdi zmdi-chevron-down icon"
                                                style="vertical-align: middle;"></i></span>
                                                <i class="fa fa-chevron-left"></i>
                                            </div>
                                            <input type="hidden" name="payment" id="payment">
                                            <ul class="dropdown-menu">
                                                <li onclick="changePayment('VISA')" id="VISA">VISA</li>
                                                <li onclick="changePayment('PAYPAL')"id="PAYPAL">PAYPAL</li>
                                                <li onclick="changePayment('MC')"id="MC">MC</li>
                                                <li onclick="changePayment('MB')"id="MB">MB</li>
                                                <li onclick="changePayment('MBway')"id="MBway">MBway</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                @if (Auth::user())
                                <button id="btnSubmit" class="flex-c-m stext-101 cl2 size-116 bg8 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="button" onclick="verificacao()">
                                    Place Order
                                </button>
                                @else
                                <a class="flex-c-m stext-101 cl2 size-116 bg8 bor14 hov-btn3 p-lr-15 trans-04 pointer" href="{{ route('login') }}">Login</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Back to top -->
            <div class="btn-back-to-top" id="myBtn">
                <span class="symbol-btn-back-to-top">
                    <i class="zmdi zmdi-chevron-up"></i>
                </span>
            </div>
        </div>

        <script>
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


            var Payment="";

            function changePayment($paymentMethod){
                var btnSubmit = document.querySelector('#btnSubmit');

                Payment = $paymentMethod;
                btnSubmit.type = "submit"
            }
            function verificacao(){
                if(Payment == ""){
                    alert("Deve inserir o meio de pagamento.");
                }
            }
        </script>

    </body>
    </html>
    @endsection
