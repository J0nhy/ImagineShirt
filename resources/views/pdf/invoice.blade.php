<!DOCTYPE html>
<html>
<head>
    <title>Encomenda</title>
    <style>
        /* Estilos CSS para o PDF */
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            margin-bottom: 10px;
        }

        .logo img {
            max-width: 200px;
        }

        .order-info {
            margin-bottom: 20px;
        }

        .order-info p {
            margin: 5px 0;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .items-table th {
            background-color: #f9f9f9;
            text-align: left;
        }

        .items-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="img/image2.png" alt="Logo">
        </div>
        <h1>Informações da Encomenda</h1>
    </div>

    <div class="order-info">
        <p>Cliente: {{ $encomenda->user->name }}</p>
        <p>Order ID: {{ $encomenda->id }}</p>
        <p>Data: {{ $encomenda->date }}</p>
    </div>

    <h2>Itens</h2>
    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Imagem</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach ($itens as $item)
            <tr>
                <td>{{ $item->tshirtImage->name }}</td>
                <td><img src="tshirt_images/{{$item->tshirtImage->image_url}}" style="width: 50px; height:50px;"></td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->unit_price }}</td>
                <td>{{ $encomenda->total_price }}</td>
                <?php $total += $encomenda->total_price; ?>

            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total: {{ $total }} €</p>
    </div>
</body>
</html>





