<?php
$iterator=0;
?>
@extends('layout')
@section('main')
<div class="container" style="max-width: 90% !important;">
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

        <span class="stext-109 cl4">
            Pedidos
        </span>
    </div>

    <div class="tableList background" style="margin: 5% 0% 0% 0%;">
        <table class="table-shopping-cart">
            <tr class="table_head" style="border-top: 0px solid transparent;">
                <th class="cols">Estado</th>
                <th class="cols">Data</th>
                <th class="cols">Total Pago</th>
                <th class="cols">Observações</th>
                <th class="cols">NIF</th>
                <th class="cols">Endereço</th>
                <th class="cols">Tipo de Pagamento</th>
                <th class="cols">Data da Encomenda</th>
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
                            <td class="cols">{{ $order->date }}</td>
                        </tr>
                    <?php 
                        $iterator++;
                    ?>
            @endforeach
        </table>
    </div>
</div>
@endsection
</body>
</html>