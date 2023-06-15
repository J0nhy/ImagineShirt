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

    <div class="tableList background" style="margin: 5%; margin-bottom: 0%;">
        <table class="table-shopping-cart">
            <tr class="table_head" style="border-top: 0px solid transparent;">
                <th class="cols">Estado</th>
                <th class="cols">Data</th>
                <th class="cols">Total Pago</th>
                <th class="cols">Observações</th>
                <th class="cols">NIF</th>
                <th class="cols">Endereço</th>
                <th class="cols">Tipo de Pagamento</th>
            </tr>
            @foreach($orders->reverse() as $order)
                        <tr class="rows" id="linha<?= $iterator; ?>" onclick="window.location='/viewOrder/{{ $order->id }}'">
                            <td class="cols">{{ $order->status }}</td>
                            <td class="cols">{{ $order->date }}</td>
                            <td class="cols">{{ $order->total_price }}</td>
                            <td class="cols">{{ $order->notes }}</td>
                            <td class="cols">{{ $order->nif }}</td>
                            <td class="cols">{{ $order->address }}</td>
                            <td class="cols">{{ $order->payment_type }}</td>
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