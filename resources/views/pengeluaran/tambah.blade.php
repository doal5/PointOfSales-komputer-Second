@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-15">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Pengadaan Produk</h6>
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Supplier</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="{{ route('pengeluarandetail.store') }}" method="post">
                                    @csrf
                                    <td>
                                        <div class="d-flex">
                                            <select name="id_produk" class="form-select" id="">
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach ($produk as $item)
                                                    <option value="{{ $item->id_produk }}">{{ $item->merk }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                    <input type="hidden" name="pengeluaran_id" value="{{ Request::segment(2) }}">
                                    <td>
                                        <select name="id_supplier" class="form-select" id="">
                                            <option value="">-- Pilih Supplier --</option>
                                            @foreach ($supplier as $item)
                                                <option value="{{ $item->id_supplier }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" value="" name="qty" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" value="" name="subtotal" class="form-control">
                                    </td>

                            </tr>
                        </tbody>
                    </table>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <a href="{{ route('pengeluaran.index') }}"><button class="btn btn-sm btn-danger block"><i
                                        class="fas fa-arrow-left"></i>
                                    Kembali</button></a>
                            <button type="submit" class="btn btn-sm btn-primary">Tambah <i
                                    class="fas fa-arrow-right"></i></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row p-2">
            <div class="col-md-12">
                <div class="bg-light rounded h-100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Produk</th>
                                <th>Supplier</th>
                                <th style="width: 10%">Qty</th>
                                <th style="width: 10%">Subtotal</th>
                                <th style="width: 5%"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluarandetail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->merk }}</td>
                                    <td>{{ $item->supplier->nama }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ rupiah($item->subtotal) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('pengeluaranDetail/delete?id=' . $item->id) }}"><button
                                                    class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>TOTAL</td>
                                <td></td>
                                <td>{{ rupiah($pengeluaran->total) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    @csrf
                    <div class="btn-group">
                        <a href=""><button class="btn btn-sm btn-danger"><i class="fas fa-file"></i>
                                Pending</button></a>

                        <a href="{{ url('pengeluarandetail/selesai/' . Request::segment(2)) }}"><button
                                class="btn btn-sm btn-success"><i class="fas fa-check"></i>
                                Selesai</button></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
