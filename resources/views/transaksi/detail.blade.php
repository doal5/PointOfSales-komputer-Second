<form action="">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Merk</th>
                <th scope="col">qty</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <th> <span class="badge bg-primary">{{ $item->produk->merk }}</span> </th>
                    <td>{{ $item->qty }}</td>
                    <td>{{ rupiah($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
