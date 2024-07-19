@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-16">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Produk</h6>
                    <a href="{{ route('produk.index') }}">
                        <h6 style="float: right"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                                Kembali</button></h6>
                    </a>
                    <form action="{{ url('produkupdate/' . $produk->id_produk) }}" class="row g-3" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kode_produk" id="kode_produk" value="{{ $produk->kode_produk }}">
                        <div class="col-md-12">
                            <label for="produk">Produk</label>
                            <input type="text" value="{{ $produk->produk }}" class="form-control" name="produk"
                                placeholder="Masukan Nama Produk">
                        </div>
                        <div class="col-md-6">
                            <label for="merk">Merk</label>
                            <input type="text" value="{{ $produk->merk }}" class="form-control" name="merk"
                                placeholder="Masukan Merk Produk">
                        </div>
                        <div class="col-md-6">
                            <label for="kategori">Kategori</label>
                            <select class="form-select" name="kategori">
                                @if ($produk->kategori_id == 1)
                                    <option value="{{ $produk->kategori_id }}">{{ $produk->kategori->kategori }}</option>
                                @elseif ($produk->kategori_id == 2)
                                    <option value="{{ $produk->kategori_id }}">{{ $produk->kategori->kategori }}</option>
                                @else
                                    <option value="{{ $produk->kategori_id }}">{{ $produk->kategori->kategori }}</option>
                                @endif
                                @foreach ($categori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="number" value="{{ $produk->harga_beli }}" class="form-control" name="harga_beli"
                                placeholder="Masukan Harga Beli">
                        </div>
                        <div class="col-md-5">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" value="{{ $produk->harga_jual }}" class="form-control" name="harga_jual"
                                placeholder="Masukan Harga Jual">
                        </div>
                        <div class="col-md-2">
                            <label for="stok">Stok</label>
                            <input type="number" value="{{ $produk->stok }}" class="form-control" name="stok"
                                placeholder="Stok">
                        </div>
                        <div class="col-md-12">
                            <label for="foto">foto</label>
                            <input type="file" class="form-control" name="foto" placeholder="Masukan foto">
                            <input type="text" name="foto_lama" value="{{ $produk->foto }}">
                            @if ($produk->foto)
                                <img src="{{ asset('img/produk/' . $produk->foto) }}" class="img-thumbnail" alt=""
                                    style="height: 250px; width:300px">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label for="spesifikasi">spesifikasi</label>
                        </div>
                        <div class="col-md-12">
                            <textarea name="spesifikasi" id="spesifikasi" cols="103" rows="5" value="{{ $produk->spesifikasi ?? '-' }}">{{ $produk->spesifikasi ?? '-' }}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
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
