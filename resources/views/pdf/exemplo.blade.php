<h1>Fatura</h1>
<p>Número da Fatura: {{ $order->id }}</p>
<p>Data da Fatura: {{ $order->date }}</p>
<hr>
<h2>Itens da Fatura</h2>
<table>
    <thead>
        <tr>
            <th>Color code</th>
            <th>Tamanho</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->color_code }}</td>
                <td>{{ $item->size }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->unit_price }}</td>
                <td>{{ $item->sub_total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<p>Total: {{ $order->total_price }}</p>
