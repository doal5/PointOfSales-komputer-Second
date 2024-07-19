@extends('layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <h5 class="mb-4">Analisis</h5>
                <div class="bg-light rounded h-100 p-4">
                    <h6>5 Produk Software Terlaris {{ $year }}</h6>

                    <div class="row g-3">
                        <div class="col-sm">
                            <div class="btn-group">
                                <a href="{{ route('analisis.cetak') }}">
                                    <button class="btn btn-success btn-sm">Cetak <i class="fa-solid fa-print"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="response"></div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Terjual</th>
                                </tr>
                            </thead>
                            <tbody id="tampil">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6>5 Produk Komputer Terlaris {{ $year }}</h6>
                    <div class="row g-3">
                        <div class="col-sm">
                            <div class="btn-group">
                                <a href="{{ route('analisis.cetak') }}">
                                    <button class="btn btn-success btn-sm">Cetak <i class="fa-solid fa-print"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="response"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($ptK as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
                                        <td>{{ $item->produk->merk }}</td>
                                        <td>{{ $item->produk->kategori->kategori }}</td>
                                        {{-- <td>{{ date('d F Y', strtotime($item->last_sold)) }}</td>
        <td>{{ rupiah(($item->produk->harga_jual - $item->produk->harga_beli) * $item->total) }}</td> --}}
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6>5 Produk hardware Terlaris {{ $year }}</h6>
                    <div class="row g-3">
                        <div class="col-sm">
                            <div class="btn-group">
                                <a href="{{ route('analisis.cetak') }}">
                                    <button class="btn btn-success btn-sm">Cetak <i class="fa-solid fa-print"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="response"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($ptL as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
                                        <td>{{ $item->produk->merk }}</td>
                                        <td>{{ $item->produk->kategori->kategori }}</td>
                                        {{-- <td>{{ date('d F Y', strtotime($item->last_sold)) }}</td>
        <td>{{ rupiah(($item->produk->harga_jual - $item->produk->harga_beli) * $item->total) }}</td> --}}
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6>5 Produk Laptop Terlaris {{ $year }}</h6>
                    <div class="row g-3">
                        <div class="col-sm">
                            <div class="btn-group">
                                <a href="{{ route('analisis.cetak') }}">
                                    <button class="btn btn-success btn-sm">Cetak <i class="fa-solid fa-print"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="response"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($ptLaptop as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
                                        <td>{{ $item->produk->merk }}</td>
                                        <td>{{ $item->produk->kategori->kategori }}</td>
                                        {{-- <td>{{ date('d F Y', strtotime($item->last_sold)) }}</td>
        <td>{{ rupiah(($item->produk->harga_jual - $item->produk->harga_beli) * $item->total) }}</td> --}}
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            read();
        });

        function read() {
            $.get('{{ route('analisis.read') }}', {},
                function(data, status) {
                    $('#tampil').html(data);
                },
            );
        }
    </script>
@endpush
