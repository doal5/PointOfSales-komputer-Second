@extends('layouts.master')

@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <h5 class="mb-4">Laporan</h5>
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Laporan</h6>
                    <div class="row p-2">
                        <div class="col-md-12">
                            <div class="bg-light rounded h-10 p-2">
                                <form class="row p-2" target="" method="get">
                                    <div class="col-6">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" class="form-control" id="tanggalawal" name="tanggalawal">
                                    </div>
                                    <div class="col-6">
                                        <label>Tanggal Akhir</label>
                                        <input type="date" class="form-control" id="tanggalakhir" name="tanggalakhir"
                                            placeholder="Password">
                                    </div>
                                    <div class="d-grid gap-2 col-12 mt-3 mx-auto">
                                        <button class="btn btn-primary" type="submit">Button</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkboxMain" class="form-check-input"></th>
                                    <th>No</th>
                                    <th>Kode_produk</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($transaksi)
                                    <div class="row g-3">
                                        <div class="col-sm">
                                            <div class="btn-group">
                                                <button class="btn btn-success btn-sm">Cetak <i
                                                        class="fa-solid fa-print"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($transaksi as $item)
                                        <tr id="tr_{{ $item->id }}">
                                            <th><input type="checkbox" data-id="{{ $item->id }}"
                                                    class="form-check-input checkbox"></th>
                                            <td>{{ $i++ }}</td>
                                            <td> <span class="badge bg-primary"> {{ $item->produk->kode_produk }}</span>
                                            </td>
                                            <td>{{ $item->produk->merk }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ rupiah($item->subtotal) }}</td>
                                            <td>
                                                @if ($item->transaksi->status == 'selesai')
                                                    <span class="badge bg-success">{{ $item->transaksi->status }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $item->transaksi->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            read();


            // ========================================================
            // ================ FUNGSI HAPUS MULTIPLE ===============
            // ========================================================
            $('#checkboxMain').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $('.checkbox').prop('checked', true);
                } else {
                    $('.checkbox').prop('checked', false);
                }
            });

            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#checkboxMain').prop('checked', true);
                } else {
                    $('#checkboxMain').prop('checked', false);
                }
            });

            $('.hapus-multiple').on('click', function(e) {
                var userIdArr = [];
                $('.checkbox:checked').each(function() {
                    userIdArr.push($(this).attr('data-id'));
                });
                if (userIdArr.length <= 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Pilih Data Untuk Dihapus!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        title: "Yakin Akan Menghapus Data??",
                        text: "Akan Menghapus Data Yang Dipilih",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Hapus!!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var stuId = userIdArr.join(",");
                            $.ajax({
                                type: "delete",
                                url: "{{ url('produkhapusmultiple') }}/" + stuId,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: 'ids=' + stuId,
                                success: function(data) {
                                    if (data['status'] == true) {
                                        $('.checkbox:checked').each(function() {
                                            $(this).parents('tr').remove();
                                        });
                                        Swal.fire({
                                            title: "Terhapus!!",
                                            text: "Data Terpilih Berhasil Dihapus",
                                            icon: "success"
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Data Gagal Dihapus",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                },
                                error: function(data) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Data Gagal Dihapus",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                        }
                    });
                }
            });
            // ========================================================
            // ================ FUNGSI HAPUS MULTIPLE ===============
            // ========================================================


        });

        // ========================================================
        // ================ FUNGSI MENAMPILKAN DATA ===============
        // ========================================================
        function read() {
            $.get('{{ route('produk.read') }}', {},
                function(data, status) {
                    $('#tampil').html(data);
                },
            );
        }
        // ========================================================
        // ================ FUNGSI MENAMPILKAN DATA ===============
        // ========================================================



        // ========================================================
        // ================ FUNGSI MENAMBAHKAN DATA ===============
        // ========================================================
        function tambah() {
            $.get('{{ route('produk.create') }}', {},
                function(data, status) {
                    $('#modalForm').modal('show');
                    $('#modalFormLabel').text('Tambah Data');
                    $('#page').html(data);
                },

            );
        }


        function store() {
            var merk = $('#merk').val();
            var harga_jual = $('#harga_jual').val();
            var kategori = $('#kategori').val();
            var harga_beli = $('#harga_beli').val();
            var stok = $('#stok').val();

            $.ajax({
                type: "get",
                url: "{{ route('produk.store') }}",
                data: {
                    merk: merk,
                    harga_jual: harga_jual,
                    kategori: kategori,
                    harga_beli: harga_beli,
                    stok: stok
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Menyimpan Data",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#modalForm').modal('hide');
                    read();
                }

            });
        }
        // ========================================================
        // ================ FUNGSI MENAMBAHKAN DATA ===============
        // ========================================================



        // ========================================================
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================
        function show(id) {
            $.get('{{ url('produkshow') }}/' + id, {},
                function(data, status) {
                    $('#modalForm').modal('show');
                    $('#modalFormLabel').text('Edit Data Produk');
                    $('#page').html(data);
                },
            );
        }

        function detail(id) {
            $.get('{{ url('produkdetail') }}/' + id, {},
                function(data, status) {
                    $('#modalFormDetail').modal('show');
                    $('#modalFormLabelDetail').text('Detail Data Produk');
                    $('#halaman').html(data);
                },
            );
        }
        // ========================================================
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================

        // ========================================================
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================

        function update(id) {
            var kode_produk = $('#kode_produk').val();
            var kategori_id = $('#kategori_id').val();
            var merk = $('#merk').val();
            var harga_beli = $('#harga_beli').val();
            var harga_jual = $('#harga_jual').val();
            var stok = $('#stok').val();

            $.ajax({
                type: "get",
                url: "{{ url('produkupdate') }}/" + id,
                data: {
                    kode_produk: kode_produk,
                    kategori_id: kategori_id,
                    merk: merk,
                    harga_beli: harga_beli,
                    harga_jual: harga_jual,
                    stok: stok
                },
                success: function(response) {
                    read();
                    Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Diupdate',
                            showConfirmButton: true
                        }),
                        $('#modalForm').modal('hide');
                }
            });
        }

        // ========================================================
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================


        // ========================================================
        // ================ FUNGSI HAPUS DATA ===============
        // ========================================================
        function destroy(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('produkhapus') }}/" + id,
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            read();
                        }
                    });
                }
            });
        }
        // ========================================================
        // ================ FUNGSI HAPUS DATA ===============
        // ========================================================
    </script>
@endpush
