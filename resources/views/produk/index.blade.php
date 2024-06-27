@extends('layouts.master')

@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <h5 class="mb-4">Produk</h5>
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Data Produk</h6>
                    <div class="table-responsive">
                        <div class="btn-group">
                            <button id="tambahProduk" class="btn btn-primary btn-sm"><i class="fa fa-plus"> </i>
                                Tambah</button>
                            <button class="btn btn-danger btn-sm hapus-multiple"><i class="fa fa-trash"> </i> Hapus</button>

                        </div>
                        <div class="response"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkboxMain" class="form-check-input"></th>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Merk</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th style="width: 20%"><i class="fa fa-cog"></i></th>
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

    @includeIf('produk.modalForm')
    @includeIf('produk.tambah')
    @includeIf('produk.modalFormDetail')
    <!-- Table End -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            read();

            // menampilkan modal tambah produk
            $('#tambahProduk').click(function() {
                $('#modalProduk').modal('show');
            });

            // tambah produk
            $('#produk').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    method: 'post',
                    url: '{{ route('produk.store') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil Menyimpan Data",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#modalProduk').modal('hide');
                        read();
                    }
                });
            });

            // update produk
            // $('#updateProduk').on('submit', function(e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');
            //     var formData = new FormData(this);
            //     $.ajax({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //         },
            //         method: 'post',
            //         url: $(this).prop('action'),
            //         data: formData,
            //         cache: false,
            //         contentType: false,
            //         processData: false,

            //         success: function(response) {
            //             Swal.fire({
            //                 icon: "success",
            //                 title: "Berhasil Update Data",
            //                 showConfirmButton: false,
            //                 timer: 1500
            //             })
            //             $('#modalProduk').modal('hide');
            //             read();
            //         },
            //         error: function(response) {
            //             console.log(response);
            //         }
            //     });
            // });




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
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================
        function show(id) {
            $.get('{{ url('produkshow') }}/' + id, {},
                function(data, status) {
                    $('#editProduk').modal('show');
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
        // ================ FUNGSI Update DATA ===============
        // ========================================================
        function update(id) {
            var kode_produk = $('#kode_produk').val();
            var kategori_id = $('#kategori_id').val();
            var merk = $('#merk').val();
            var harga_beli = $('#harga_beli').val();
            var harga_jual = $('#harga_jual').val();
            var stok = $('#stok').val();
            var foto = $('#foto').val();

            $.ajax({
                type: "post",
                url: "{{ url('produkupdate') }}/" + id,
                data: {
                    kode_produk: kode_produk,
                    kategori_id: kategori_id,
                    merk: merk,
                    harga_beli: harga_beli,
                    harga_jual: harga_jual,
                    stok: stok,
                    foto: foto
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
        // ================ FUNGSI Update DATA ===============
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
