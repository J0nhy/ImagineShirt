<?php
$iterator = 0;
?>
@extends('layout')
@section('main')
    <div class="container">
        @if (session('message'))
            <script>
                alert('{{ session('message') }}');
            </script>
        @endif
        <!-- breadcrumb -->
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg breadcrumbs">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('pedidos.orders') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Pedidos
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Detalhes
            </span>
            <div class="width80" style="float: right">
                <a class="linkBranco" style="float: right" href="/pdf/<?=$id?>">Fatura PDF <i class="zmdi zmdi-download"></i></a>    
            </div>
        </div>
        <div class="tableList background" style="margin: 5% 10% 0% 10%; ">
            <table class="table-shopping-cart">
                <tr class="table_head" style="border-top: 0px solid transparent;">
                    <th class="column-1">Product</th>
                    <th class="column-2"></th>
                    <th class="column-3">Price</th>
                    <th class="column-4">Quantity</th>
                    <th class="column-4">Total</th>
                </tr>
                @foreach ($produtos as $item)
                    <tr class="table_row" style="border-bottom: 0px solid transparent;">
                        <td class="column-1">
                            <div class="how-itemcart1" onclick="expandirImagem('<?= $iterator ?>')">
                                <img src="/tshirt_images/{{ $item['image_url'] }}" class="card-img-top center"
                                    alt="{{ $item['image_url'] }}" id="img<?= $iterator ?>">
                            </div>
                            <!-- Pop-up -->
                            <div class="popup" id="popup<?= $iterator ?>" onclick="fecharPopUp('<?= $iterator ?>')">
                                <div class="popup-content">
                                    <img id="baseTshirt" src="/tshirt_base/{{ $item['colorCode'] }}.png" alt="IMG-PRODUCT"
                                        style="width: 80%; height: 80%; max-height: none;object-fit: contain; position:absolute; z-index: 1;">
                                    <div
                                        style="height: 350px; width: 300px;  position:absolute; z-index: 2; top: 50%; left: 50.5%; transform: translate(-52%,-50%);">
                                        <img id="fotoTshirt<?= $iterator ?>" src="/tshirt_images/{{ $item['image_url'] }}" alt="IMG-PRODUCT"
                                            style="object-fit: cover; max-width:215px; max-height:410px;"
                                            class="popup-image">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="column-2"><b><?= $item['name'] ?></b><br><?= $item['cor'] ?><br><?= $item['size'] ?></td>
                        <td id="price<?= $iterator ?>" class="column-3"><?= $item['price'] ?>€</td>
                        <td class="txt-center" id="qty<?= $iterator ?>" name="qty<?= $iterator ?>"><?= $item['qtd'] ?></td>
                        <td id="total<?= $iterator ?>" class="column-4"><?= $item['price'] * $item['qtd'] ?>€</td>
                    </tr>
                    <?php
                    $iterator++;
                    ?>
                @endforeach
            </table>
        </div>
    </div>
    <script>
        function expandirImagem(img) {
            var imagem = document.querySelector('#img'+img);
            var popup = document.querySelector('#popup'+img);
            var popupImage = document.querySelector('#fotoTshirt'+img);

            // Define a imagem expandida
            popupImage.src = imagem.src;

            // Exibe o pop-up
            popup.style.display = 'flex';
        }

        function fecharPopUp(img) {
            var popup = document.querySelector('#popup'+img);
            popup.style.display = 'none';
        }
    </script>
@endsection
</body>

</html>
