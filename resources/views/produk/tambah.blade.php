<form action="">
    @csrf
    <div class="form-group">
        <label for="merk">Merk</label>
        <input type="text" class="form-control" id="merk" placeholder="Masukan Merk Produk">
    </div>
    {{-- <div class="form-group">
        <label for="kode_produk">kode produk</label>
        <input type="text" class="form-control" id="kode_produk" placeholder="Masukan kode produk">
    </div> --}}
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select class="form-control" name="kategori" id="kategori">
            <option value="">Masukan Kategori</option>
            @foreach ($kategori as $item)
                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" class="form-control" id="harga_beli" placeholder="Masukan Harga Beli">
    </div>
    <div class="form-group">
        <label for="harga_jual">Harga Jual</label>
        <input type="number" class="form-control" id="harga_jual" placeholder="Masukan Harga Jual">
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" placeholder="Masukan Stok">
    </div>
    <div class="form-group">
        <label for="foto">foto</label>
        <input type="file" class="form-control" id="foto" placeholder="Masukan Stok">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
    </div>
</form>
