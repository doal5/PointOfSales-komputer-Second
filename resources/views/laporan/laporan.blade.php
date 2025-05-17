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
            <th></th>
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
        </tr>
    </thead>
    <tbody>
        @foreach ($pengeluaran as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->total }}</td>
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
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>LABA BERSIH</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th width="10%">No</th>
            <th width="30%">Keterangan</th>
            <th width="30%">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Total keuntungan</td>
            <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Total pengeluaran</td>
            <td>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td>Total</td>
            <td>Rp {{ number_format($totalKeuntunganBersih, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>
