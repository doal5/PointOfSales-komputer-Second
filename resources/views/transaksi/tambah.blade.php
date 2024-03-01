@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-15">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">{{ $title }}</h6>
                    <table>
                        <thead>
                            <tr>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
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
                                </td>
                                <form action="{{ route('transaksidetail.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_produk" value="{{ $pdetail->id_produk ?? '' }}">
                                    <input type="hidden" name="transaksi_id" value="{{ Request::segment(2) }}">
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    <input type="hidden" name="diskon" value="{{ $diskon }}">

                                    <td>
                                        <input type="text" value="{{ $pdetail->merk ?? '' }}" name="merk"
                                            class="form-control" disabled>
                                    </td>
                                    <td><input type="text" value="{{ $pdetail->harga_jual ?? '' }}" name="harga_jual"
                                            class="form-control" disabled>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="?id_produk={{ request('id_produk') }}&act=min&qty={{ $qty }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></a>
                                            <input style="width: 27%" type="number" class="form-control" name="qty"
                                                value="{{ $qty ?? 0 }}">
                                            <a href="?id_produk={{ request('id_produk') }}&act=plus&qty={{ $qty }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rp.{{ $subtotal ?? '' }}</h5>
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <a href="{{ route('transaksi.index') }}"><button class="btn btn-sm btn-danger block"><i
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
            <div class="col-md-6">
                <div class="bg-light rounded h-100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Produk</th>
                                <th style="width: 10%">Qty</th>
                                <th style="width: 10%">Subtotal</th>
                                <th style="width: 5%"><i class="fa fa-gear"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksidetail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->merk }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ rupiah($item->subtotal) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('transaksiDetail/delete?id=' . $item->id) }}"><button
                                                    class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @csrf
                    @foreach ($transaksidetail as $item)
                        <label for="">id produk</label>
                        <input type="text" name="id_produk" value="{{ $item->id_produk }}"> <br>
                        <label for="">qty</label>
                        <input type="text" name="qty" value="{{ $item->qty }}"> <br>
                        <label for="">transaksi id</label>
                        <input type="text" name="transaksi_id" value="{{ $item->transaksi_id }}">
                    @endforeach
                    <div class="btn-group">
                        <a href=""><button class="btn btn-sm btn-danger"><i class="fas fa-file"></i>
                                Pending</button></a>
                        <a href="{{ url('transaksiDetail/selesai/' . Request::segment(2)) }}"><button
                                class="btn btn-sm btn-success"><i class="fas fa-check"></i>
                                Selesai</button></a>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-light rounded h-100 p-4">
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="">Total Belanja</label>
                            <input disabled type="number" name="total_belanja" value="{{ $transaksi->total ?? 0 }}"
                                class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">Diskon</label>
                            <input type="number" name="diskon" value="{{ $diskon ?? 0 }}" class="form-control"
                                id="">
                        </div>
                        <div class="form-group">
                            <label for="">Total Belanja</label>
                            <input disabled type="number" name="total_belanja"
                                value="{{ rupiah($transaksi->total ?? 0) }}" class="form-control" id="">
                        </div>

                        <div class="form-group">
                            <label for="">Dibayarkan</label>
                            <input type="number" name="dibayarkan" value="{{ $dibayarkan ?? 0 }}" class="form-control"
                                id="">
                        </div> <br>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block"> Hitung</button>
                        </div> <br>
                    </form>
                    <div class="form-group">
                        <label for="">Uang Kembalian</label>
                        <input disabled type="text" class="form-control" value="{{ rupiah($kembalian ?? 0) }}"
                            name="kembalian">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
