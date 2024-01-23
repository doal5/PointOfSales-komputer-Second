<form action="">
    @csrf
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama" value="{{ $supplier->nama }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Masukan Email"
            value="{{ $supplier->email }}">
    </div>
    <div class="form-group">
        <label for="no_telepon">No Telepon</label>
        <input type="number" class="form-control" id="no_telepon" placeholder="Masukan No Telepon"
            value="{{ $supplier->no_telepon }}">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat"
            value="{{ $supplier->alamat }}">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update({{ $supplier->id_supplier }})">Simpan</button>
    </div>
</form>
