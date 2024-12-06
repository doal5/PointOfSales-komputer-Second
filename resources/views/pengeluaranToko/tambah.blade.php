@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-15">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Pengadaan Produk</h6>
                    <a href="{{ url('pengeluaran') }}">
                        <h6 style="float: right"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                                Kembali</button></h6>

                    </a>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 30%">Produk</th>
                                <th style="width: 30%">Supplier</th>
                                <th>Qty</th>
                                <th style="width: 30%">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="{{ route('pengeluarandetail.store') }}" method="post">
                                    @csrf
                                    <td>
                                        <div class="d-flex">
                                            <select name="id_produk" class="form-select" id="" required>
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach ($produk as $item)
                                                    <option value="{{ $item->id_produk }}">{{ $item->produk }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                    <input type="hidden" name="pengeluaran_id" value="{{ Request::segment(2) }}">
                                    <td>
                                        <select name="id_supplier" class="form-select" id="" required>
                                            <option value="">-- Pilih Supplier --</option>
                                            @foreach ($supplier as $item)
                                                <option value="{{ $item->id_supplier }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" value="" name="qty" required class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" value="" name="subtotal" required class="form-control">
                                    </td>

                            </tr>
                        </tbody>
                        <label for="">Keterangan</label> <br>
                        <textarea name="keterangan" id="keterangan-awal" id="" required class="form-control mb-2" cols="112"
                            rows="3">{{ $pengeluaran->keterangan ?? '' }}</textarea>
                    </table>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Tambah
                                <i class="fas fa-arrow-right"></i>
                            </button>
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
                        <a href="{{ route('pengeluaran.index') }}"><button class="btn btn-sm btn-danger"><i
                                    class="fas fa-file"></i>
                                Batal</button></a>

                        {{-- Update Keterangan --}}
                        <form action="{{ route('pengeluaranUpd') }}" method="POST">
                            @csrf
                            <input type="hidden" name="keterangan" id="keterangan-new"
                                value="{{ $pengeluaran->keterangan ?? '' }}">
                            <input type="hidden" name="subtotal" value="{{ $pengeluaran->total }}">
                            <input type="hidden" name="pengeluaran_id" value="{{ Request::segment(2) }}">
                            <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-check"></i>
                                Selesai
                            </button>
                        </form>
                        {{-- Update Keterangan --}}

                    </div>
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
        </script>
    @endpush
@endsection
