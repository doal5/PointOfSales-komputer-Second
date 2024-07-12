<h4>Laporan Periode {{ date('d F Y', strtotime($tglawal)) . ' S/d ' . date('d F Y', strtotime($tglakhir)) }}</h4>
<table>
    <thead>
        <tr>
            <th></th>
            <th>PEMASUKAN</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>NO</th>
            <th>KODE PRODUK</th>
            <th>PRODUK</th>
            <th>QTY</th>
            <th>SUBTOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->produk->kode_produk }}</td>
                <td>{{ $item->produk->merk }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>TOTAL</th>
            <th>{{ $total }}</th>
        </tr>
    </tfoot>
</table>

<table>
    <thead>
        <tr>
            <th></th>
            <th>PENGELUARAN</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>NO</th>
            <th>KETERANGAN</th>
            <th>TOTAL</th>
            <th>TANGGAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengeluaran as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>TOTAL</th>
            <th>{{ $totalPengeluaran }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>
