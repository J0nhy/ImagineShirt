<?php
$iterator=0;
?>
@extends('layout')
@section('main')
<div class="background">
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

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>

    <div class="tableList background" style="margin: 5% 20% 0% 20%; ">
        <table class="table-shopping-cart">
            <tr class="table_head" style="border-top: 0px solid transparent;">
                <th class="column-1">Product</th>
                <th class="column-2"></th>
                <th class="column-3">Price</th>
                <th class="column-4">Quantity</th>
                <th class="column-4">Total</th>
            </tr>
            @foreach($produtos as $item)
            <tr class="table_row" style="border-bottom: 0px solid transparent;">
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="/tshirt_images/{{$item["image_url"]}}" class="card-img-top center" alt="{{ $item["image_url"] }}">
                        </div>
                    </td>
                    <td class="column-2"><b><?= $item["name"]; ?></b><br><?= $item["cor"]; ?><br><?= $item["size"]; ?></td>
                    <td id="price<?= $iterator; ?>" class="column-3"><?= $item["price"] ?>€</td>
                    <td class="txt-center" id="qty<?= $iterator; ?>" name="qty<?= $iterator; ?>"><?= $item["qtd"]; ?></td>
                    <td id="total<?= $iterator; ?>" class="column-4"><?= $item["price"] * $item["qtd"] ?>€</td>
            </tr>
            <?php
                $iterator++;
            ?>
            @endforeach
        </table>
    </div>
</div>
</body>
</html>