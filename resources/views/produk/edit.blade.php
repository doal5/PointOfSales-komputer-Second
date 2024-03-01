<form action="">
    @csrf
    <div class="form-group text-capitalize">
        <input type="hidden" id="kode_produk" value="{{ $data->kode_produk }}">
        <input type="hidden" id="kategori_id" value="{{ $data->kategori_id }}">
        <label for="merk">merk</label>
        <input type="text" class="form-control" id="merk" placeholder="Masukan merk"
            value="{{ $data->merk ?? '' }}">
    </div>
    <div class="form-group">
        <label for="harga_beli">harga beli</label>
        <input type="number" class="form-control" id="harga_beli" placeholder="Masukan harga beli"
            value="{{ $data->harga_beli }}"></input>
    </div>
    <div class="form-group">
        <label for="harga_jual">harga jual</label>
        <input type="number" class="form-control" id="harga_jual" placeholder="Masukan harga jual"
            value="{{ $data->harga_jual }}">
    </div>
    <div class="form-group">
        <label for="stok">stok</label>
        <input type="text" class="form-control" id="stok" placeholder="Masukan stok"
            value="{{ $data->stok }}">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update({{ $data->id_produk }})">Simpan</button>
    </div>
</form>
