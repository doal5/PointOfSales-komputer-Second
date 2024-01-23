<form action="">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Kode Produk</th>
                <th scope="col">Merk</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Stok</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th> <span class="badge bg-primary">{{ $data->kode_produk }}</span> </th>
                <td>{{ $data->merk }}</td>
                <td>{{ $data->harga_beli }}</td>
                <td>{{ $data->harga_jual }}</td>
                <td>{{ $data->stok }}</td>
            </tr>
        </tbody>
    </table>
</form>
