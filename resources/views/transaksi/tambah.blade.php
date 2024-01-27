@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row p-2">

            <div class="col-md-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">{{ $title }}</h6>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Kode Produk</label>
                        </div>
                        <div class="col-md-8">
                            <form method="GET">
                                <div class="d-flex">
                                    <select name="id_produk" class="form-control" id="">
                                        <option value="">-- {{ $pdetail->merk ?? 'Pilih Produk' }} --</option>
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->id_produk }}">{{ $item->merk }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-primary">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('transaksidetail.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $pdetail->id_produk ?? '' }}">
                        <input type="hidden" name="transaksi_id" value="{{ Request::segment(2) }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ $pdetail->merk ?? '' }}" name="merk" class="form-control"
                                    disabled>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Harga Satuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ $pdetail->harga_jual ?? '' }}" name="harga_jual"
                                    class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Qty</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="?id_produk={{ request('id_produk') }}&act=min&qty={{ $qty }}"
                                        class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></a>
                                    <input style="width: 27%" type="number" class="form-control" name="qty"
                                        value="{{ $qty ?? '' }}">
                                    <a href="?id_produk={{ request('id_produk') }}&act=plus&qty={{ $qty }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Subtotal</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <h5>Rp.{{ $subtotal ?? '' }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="{{ route('transaksi.index') }}"><button class="btn btn-sm btn-danger"><i
                                                class="fas fa-arrow-left"></i> Kembali</button></a>
                                    <button type="submit" class="btn btn-sm btn-primary">Tambah <i
                                            class="fas fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-light rounded h-100 p-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Produk</th>
                                <th style="width: 10%">Qty</th>
                                <th style="width: 5%"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksidetail as $item)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $item->produk->merk }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <a href=""><button class="btn btn-sm btn-danger"><i class="fas fa-file"></i>
                                Pending</button></a>
                        <a href=""><button class="btn btn-sm btn-success"><i class="fas fa-check"></i>
                                Selesai</button></a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row p-2">
            <div class="col-md-6">
                <div class="bg-light rounded h-100 p-4">
                    <div class="form-group">
                        <label for="">Diskon</label>
                        <input type="number" name="diskon" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input disabled type="number" name="total_belanja" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="number" name="dibayarkan" class="form-control" id="">
                    </div> <br>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block"> Hitung</button>
                    </div> <br>

                    <div class="form-group">
                        <label for="">Uang Kembalian</label>
                        <input disabled type="number" class="form-control" name="kembalian">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
