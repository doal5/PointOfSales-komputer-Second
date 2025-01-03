@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-16">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Tambah Produk</h6>
                    <a href="{{ route('produk.index') }}">
                        <h6 style="float: right"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                                Kembali</button></h6>
                    </a>
                    <form action="{{ route('produk.store') }}" class="row g-3" method="POST" id="produk"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="produk">Produk</label>
                            <input type="text" class="form-control" name="produk" placeholder="Masukan Nama Produk">
                        </div>
                        <div class="col-md-6">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control" name="merk" placeholder="Masukan Merk Produk">
                        </div>
                        <div class="col-md-6">
                            <label for="kategori">Kategori</label>
                            <select class="form-select" name="kategori">
                                <option value="">Masukan Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" placeholder="Masukan Harga Beli">
                        </div>
                        <div class="col-md-6">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" class="form-control" name="harga_jual" placeholder="Masukan Harga Jual">
                        </div>
                        <div class="col-md-12">
                            <label for="foto">foto</label>
                            <input type="file" class="form-control" name="foto" placeholder="Masukan foto">
                        </div>
                        <div class="col-md-12">
                            <label for="spesifikasi">spesifikasi</label>
                        </div>
                        <div class="col-md-12">
                            <textarea name="spesifikasi" id="spesifikasi" cols="103" rows="5"></textarea>

                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#keterangan-awal').on('input', function() {
                    $('#keterangan-new').val($(this).val());
                });
            });

            tinymce.init({
                selector: '#spesifikasi',
                plugins: ['quickbars'],
                menubar: false,
                statusbar: false,
                height: 300
            })
        </script>
    @endpush
@endsection
