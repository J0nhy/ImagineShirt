@extends('layout')
@section('main')
    <div class="container Margintp5">

        {{-- inicio da Zona de testes para o carrinho --}}
        @if (session('message'))
            <script>
                alert('{{ session('message') }}');
            </script>
        @endif
        {{-- fim da Zona de testes para o carrinho --}}
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div id="fields">

                    <input type="text" class="inputText width80 marginr5" name="Nome" id="Nome" min="1"
                        max="30" placeholder="Nome" required value="{{ $user->name }}">
                    <input type="text" class="inputText width80 marginr5" name="Email" id="Email" min="1"
                        max="30" placeholder="Email" required value="{{ $user->email }}">
                    <input type="text" class="inputText width44 marginb5" name="NIF" id="NIF"
                        min="1" max="9" placeholder="NIF" value="<?= $customer->nif ?? ''; ?>">
                    <!-- Dropdown -->
                    <div class="dropdown p-t-33 marginb5">
                        <div class="select">
                            <span style="color:black !important;" id="paymentTxt"><?= $customer->default_payment_type ?? 'Pagamento Padrão '; ?><i
                                    class="zmdi zmdi-chevron-down icon" style="vertical-align: middle;"></i></span>
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
                    <input type="text" class="inputText width80" name="Morada" id="Morada" min="10"
                        max="100" placeholder="Morada" value="<?= $customer->address ?? ''; ?>">

                </div>

            </div>
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <img id="avatar" src="<?= $user->photo_url != '' ? '/photos/' . $user->photo_url : '/img/avatar_unknown' ?>.png" alt="Avatar" class="iconPerfil">
                <a href="#" style="width: 40%; margin-left:2.5%" class="btn btn-primary mb-3 px-4 flex-grow-1">Editar</a><br>
                <a href="#" style="width: 40%; margin-left:2.5%" class="btn btn-secondary mb-3 px-4 flex-shrink-1">mudar pass</a><br>
                <a href="#" style="width: 40%; margin-left:2.5%; background-color: rgb(179, 0, 0); border-color: rgb(179, 0, 0);" class="btn btn-secondary mb-3 px-4 flex-shrink-1">encerrar conta</a>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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


        var Payment = "";

        function changePayment($paymentMethod) {
            var btnSubmit = document.querySelector('#btnSubmit');

            Payment = $paymentMethod;
            btnSubmit.type = "submit"
        }

        function verificacao() {
            if (Payment == "") {
                alert("Deve inserir o meio de pagamento.");
            }
        }
    </script>
@endsection
</body>

</html>
