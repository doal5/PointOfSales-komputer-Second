<h4>Top 5 Terlaris</h4>
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>KODE PRODUK</th>
            <th>PRODUK</th>
            <th>KATEGORI</th>
            <th>PENJUALAN TERAKHIR</th>
            <th>KEUNTUNGAN</th>
            <th>TERJUAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pt as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->produk->kode_produk }}</td>
                <td>{{ $item->produk->produk }}</td>
                <td>{{ $item->produk->kategori->kategori }}</td>
                <td>{{ date('d F Y', strtotime($item->last_sold)) }}</td>
                <td>{{ rupiah(($item->produk->harga_jual - $item->produk->harga_beli) * $item->total) }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
