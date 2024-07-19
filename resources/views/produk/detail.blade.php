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
        <table class="table">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><img src="{{ asset('img/produk/' . $data->foto) }}" alt="" width="250"></th>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th></th>
                <th></th>
                <th>
                    <textarea name="spesifikasi" id="spesifikasi" cols="30" rows="10" readonly>{{ $data->spesifikasi }}</textarea>
                </th>
                <th></th>
                <th>

                </th>
            </tr>
        </table>
    </table>
</form>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#spesifikasi',
        menubar: false,
        statusbar: false,
        height: 300,
        width: 400,
        readonly: true
    })
</script>
