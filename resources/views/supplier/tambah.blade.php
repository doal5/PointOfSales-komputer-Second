<form action="">
    @csrf
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Supplier">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Masukan Email">
    </div>
    <div class="form-group">
        <label for="no_telepon">No Telepon</label>
        <input type="number" class="form-control" id="no_telepon" placeholder="Masukan Telepon">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
    </div>
</form>
