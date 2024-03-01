<form action="">
    @csrf
    <div class="form-group text-capitalize">
        <label for="merk">merk</label>
        <input type="text" class="form-control" id="merk" placeholder="Masukan merk" value="{{ $data->merk ?? '' }}">
    </div>
    <div class="form-group">
        <label for="harga_beli">harga beli</label>
        <input type="text" class="form-control" id="harga_beli" placeholder="Masukan harga beli"
            value="{{ rupiah($data->harga_beli) }}"></input>
    </div>
    <div class="form-group">
        <label for="harga_jual">harga jual</label>
        <input type="text" class="form-control" id="harga_jual" placeholder="Masukan harga jual"
            value="{{ rupiah($data->harga_jual) }}">
    </div>
    <div class="form-group">
        <label for="stok">stok</label>
        <input type="text" class="form-control" id="stok" placeholder="Masukan stok"
            value="{{ $data->stok }}">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
    </div>
</form>
