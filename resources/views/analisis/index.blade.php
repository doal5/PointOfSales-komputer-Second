@extends('layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h5 class="mb-4">Analisis</h5>
            <div class="row g-4">
                <div class="col-md-2 col-xl-6">
                    <div class="bg-light text-center rounded p-2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                        </div>
                        <div class="col">
                            {!! $bulanChart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-xl-6">
                    <div class="bg-light text-center rounded p-2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                        </div>
                        <div class="col">
                            {!! $bulan3Chart->container() !!}

                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xl-6">
                    <div class="bg-light text-center rounded p-2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                        </div>
                        <div class="col">
                            {!! $bulan6Chart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-xl-6">
                    <div class="bg-light text-center rounded p-2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                        </div>
                        <div class="col">
                            {!! $tahunChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6>5 Produk Software Terlaris {{ $year }}</h6>

                    <div class="row g-3">
                        <div class="col-sm">
                            <div class="btn-group">
                                <a href="{{ route('analisis.cetak', ['kategori' => 2]) }}">
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
                                @foreach ($ptS as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
                                        <td>{{ $item->produk->produk }}</td>
                                        <td>{{ $item->produk->kategori->kategori }}</td>
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
                    <h6>5 Produk Komputer Terlaris {{ $year }}</h6>
                    <div class="row g-3">
                        <div class="col-sm">
                            <div class="btn-group">
                                <a href="{{ route('analisis.cetak', ['kategori' => 4]) }}">
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

                                @foreach ($ptK as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
                                        <td>{{ $item->produk->produk }}</td>
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
                                <a href="{{ route('analisis.cetak', ['kategori' => 1]) }}">
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

                                @foreach ($ptL as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
                                        <td>{{ $item->produk->produk }}</td>
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
                                <a href="{{ route('analisis.cetak', ['kategori' => 3]) }}">
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

                                @foreach ($ptLaptop as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
                                        <td>{{ $item->produk->produk }}</td>
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
    <script src="{{ $bulanChart->cdn() }}"></script>
    {{ $bulanChart->script() }}
    <script src="{{ $bulan3Chart->cdn() }}"></script>
    {{ $bulan3Chart->script() }}
    <script src="{{ $bulan6Chart->cdn() }}"></script>
    {{ $bulan6Chart->script() }}
    <script src="{{ $tahunChart->cdn() }}"></script>
    {{ $tahunChart->script() }}
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
