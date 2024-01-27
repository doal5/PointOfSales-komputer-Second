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
                            <select name="produk_id" class="form-control" id="">
                                <option value="">-- Pilih Produk --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama_produk" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Harga Satuan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="harga_satuan" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Qty</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
                                <input type="number" class="form-control" name="qty">
                                <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Subtotal</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <h5>Rp.50000</h5>
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
                            <tr>
                                <td>1</td>
                                <td>Laptop</td>
                                <td>3</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
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
                        <label for="">Total Belanja</label>
                        <input type="number" name="total_belanja" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="number" name="dibayarkan" class="form-control" id="">
                    </div> <br>
                    <button type="submit" class="btn btn-primary btn-block"> Hitung</button>

                </div>
            </div>
        </div>
    </div>
@endsection
