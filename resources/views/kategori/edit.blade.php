<form action="">
    @csrf
    <div class="form-group">
        <label for="nama">Kategori</label>
        <input type="text" class="form-control" id="kategori" placeholder="Masukan kategori"
            value="{{ $kategori->kategori }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update({{ $kategori->id }})">Simpan</button>
    </div>
</form>
