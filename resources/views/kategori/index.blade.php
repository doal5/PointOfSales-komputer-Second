@extends('layouts.master')

@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <h5 class="mb-4">Kategori</h5>
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Data Kategori</h6>
                    <div class="table-responsive">
                        <div class="btn-group">
                            <button onclick="tambah()" class="btn btn-primary btn-sm"><i class="fa fa-plus"> </i>
                                Tambah</button>
                            <button class="btn btn-danger btn-sm hapus-multiple"><i class="fa fa-trash"> </i> Hapus</button>

                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%"><input type="checkbox" id="checkboxMain" class="form-check-input">
                                    </th>
                                    <th style="width: 15%">No</th>
                                    <th>Kategori</th>
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
    @includeIf('kategori.modalForm')
    @includeIf('kategori.modalFormDetail')
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
                                url: "{{ url('kategorihapusmultiple') }}/" + stuId,
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
                                        read();
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Data Gagal Dihapus",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        read();
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
            $.get('{{ route('kategori.read') }}', {},
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
            $.get('{{ route('kategori.create') }}', {},
                function(data, status) {
                    $('#modalForm').modal('show');
                    $('#modalFormLabel').text('Tambah Data Kategori');
                    $('#page').html(data);
                },

            );
        }

        function store() {
            var kategori = $('#kategori').val();

            $.ajax({
                type: "get",
                url: "{{ route('kategori.store') }}",
                data: {
                    kategori: kategori,
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
                        url: "{{ url('kategorihapus') }}/" + id,
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
