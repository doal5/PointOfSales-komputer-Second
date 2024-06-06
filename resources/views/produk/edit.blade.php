<!-- Modal -->
<div class="modal fade" id="editProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('produkupdate/' . $data->id_produk) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group text-capitalize">
                        <input type="hidden" name="kode_produk" value="{{ $data->kode_produk }}">
                        <label for="merk">merk</label>
                        <input type="text" class="form-control" name="merk" placeholder="Masukan merk"
                            value="{{ $data->merk ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="kategori">
                            @if ($data->kategori_id == 1)
                                <option value="{{ $data->kategori_id }}">{{ $data->kategori->kategori }}</option>
                            @elseif ($data->kategori_id == 2)
                                <option value="{{ $data->kategori_id }}">{{ $data->kategori->kategori }}</option>
                            @else
                                <option value="{{ $data->kategori_id }}">{{ $data->kategori->kategori }}</option>
                            @endif
                            @foreach ($categori as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">harga beli</label>
                        <input type="number" class="form-control" name="harga_beli" placeholder="Masukan harga beli"
                            value="{{ $data->harga_beli }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">harga jual</label>
                        <input type="number" class="form-control" name="harga_jual" placeholder="Masukan harga jual"
                            value="{{ $data->harga_jual }}">
                    </div>
                    <div class="form-group">
                        <label for="stok">stok</label>
                        <input type="text" class="form-control" name="stok" placeholder="Masukan stok"
                            value="{{ $data->stok }}">
                    </div>
                    <div class="form-group">
                        <label for="stok">foto</label>
                        <input type="file" class="form-control" name="foto" value="{{ $data->foto }}">
                        <img src="{{ asset('img/produk/' . $data->foto) }}" alt="" width="100">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
