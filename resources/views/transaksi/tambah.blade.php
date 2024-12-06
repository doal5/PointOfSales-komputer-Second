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
                            <a href="{{ url('transaksiBatal/' . Request::segment(2)) }}"><button
                                    class="btn btn-sm btn-danger block"><i class="fas fa-arrow-left"></i>
                                    Kembali</button></a>
                            <tr>
                                <td>
                                    <form method="GET">
                                        <div class="d-flex">
                                            <select name="id_produk" class="form-control" id="produk">
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach ($produk as $item)
                                                    <option value="{{ $item->id_produk }}">{{ $item->produk }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-sm btn-primary">Pilih</button>
                                        </div>
                                    </form>
                                </td>
                                <form action="{{ route('transaksidetail.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_produk" value="{{ $pdetail->id_produk ?? '' }}">
                                    <input type="text" name="transaksi_id" value="{{ Request::segment(2) }}">
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    <input type="hidden" name="diskon" value="{{ $diskon }}">

                                    <td>
                                        <input type="text" value="{{ $pdetail->produk ?? '' }}" id="merk"
                                            name="merk" class="form-control" disabled>
                                    </td>
                                    <td><input type="text" value="{{ $pdetail->harga_jual ?? '' }}" id="harga_jual"
                                            name="harga_jual_visible" class="form-control" id="harga_jual" disabled>
                                        <input type="hidden" value="{{ $pdetail->harga_jual ?? '' }}" name="harga_jual">
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input style="width: 50%" type="number" class="form-control" name="qty"
                                                value="{{ $qty ?? 0 }}">
                                        </div>
                                    </td>
                                    <td>
                                        <h5 id="subtotal">Rp.{{ $subtotal ?? '' }}</h5>
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mt-3">
                        <div class="col-md-5">
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
                                    <td>{{ $item->produk->produk }}</td>
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
                    <a href="{{ url('transaksiDetail/selesai/' . Request::segment(2)) }}"><button
                            class="btn btn-sm btn-success"><i class="fas fa-check"></i>
                            Selesai</button></a>
                    <a href="{{ url('struk/' . Request::segment(2)) }}" style="float: right"><button
                            class="btn btn-sm btn-success"><i class="fas fa-print"></i>
                            Cetak</button></a>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-light rounded h-100 p-4">
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="">Total Belanja</label>
                            <input disabled type="number" name="total_belanja" id="total_belanja"
                                value="{{ $transaksi->total ?? 0 }}" class="form-control" id="">
                        </div>
                        <label for="">Diskon %</label>
                        <div class="d-flex" style="padding-right: 250px">
                            <input type="number" name="diskon" placeholder="%" value="{{ $transaksi->diskon ?? 0 }}"
                                class="form-control">
                        </div>
                        <div class="d-grid gap-2">
                        </div>
                        <div class="form-group">
                            <label for="">Dibayarkan</label>
                            <input required type="number" name="dibayarkan" value="{{ $dibayarkan ?? 0 }}"
                                class="form-control">
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
@push('script')
    <script>
        $(document).ready(function() {
            // Tangkap event ketika inputan qty berubah
            $('input[name="qty"]').on('input', function() {
                // Ambil nilai qty dan harga jual
                var qty = $(this).val();
                var harga_jual = $('input[name="harga_jual"]').val();

                // Pastikan qty tidak kosong atau nol
                if (qty > 0) {
                    // Hitung subtotal (tanpa diskon)
                    var subtotal = qty * harga_jual;

                    // Format subtotal ke dalam format rupiah
                    var rupiah = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(subtotal);

                    // Update subtotal di halaman
                    $('#subtotal').text(rupiah);
                } else {
                    // Jika qty kosong atau nol, kosongkan subtotal
                    $('#subtotal').text('Rp.0');
                }
            });
        });
    </script>
@endpush
