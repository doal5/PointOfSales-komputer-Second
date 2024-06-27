<h4>Laporan Periode {{ $tglawal . 'S/d' . $tglakhir }}</h4>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>PRODUK</th>
            <th>QTY</th>
            <th>SUBTOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->produk->merk }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
