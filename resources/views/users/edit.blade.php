<!-- Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('userUpdate/' . $data->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan harga beli"
                            value="{{ $data->name }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="level">level</label>
                        <select class="form-control" name="level">
                            @if ($data->level == 1)
                                <option value="1">Admin</option>
                            @else
                                <option value="2">kasir</option>
                            @endif
                            <option value="1">admin</option>
                            <option value="2">kasir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $data->email }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password"
                            value="{{ $data->password_dekripsi }}">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
