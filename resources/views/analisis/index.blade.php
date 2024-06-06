@extends('layouts.master')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <h5 class="mb-4">Analisis</h5>
                <div class="bg-light rounded h-100 p-4">
                    <h6>5 Produk Terlaris</h6>
                    <div class="table-responsive">
                        <div class="response"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Keuntungan</th>
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
