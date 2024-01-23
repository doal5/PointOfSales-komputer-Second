<form action="">
    @csrf
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <input type="text" class="form-control" name="kategori" id="kategori">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
    </div>
</form>
