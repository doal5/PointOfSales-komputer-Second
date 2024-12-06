@extends('layouts.master')

@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">


            <div class="col-12">
                <h5 class="mb-4">Pengeluaran</h5>
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Data Pengeluaran</h6>

                    <div class="table-responsive">
                        @if ($message = session('sukses'))
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="float-right">
                            <a href="{{ route('pengeluaran.create') }}">
                                <button class="btn btn-primary btn-sm tambah-pengadaan" style="float: right"><i
                                        class="fa fa-plus">
                                    </i>
                                    Tambah Pengeluaran</button>
                            </a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-sm hapus-multiple"><i class="fa fa-trash"> </i> Hapus</button>
                        </div>


                        <div class="response"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkboxMain" class="form-check-input"></th>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                    <th style="width: 20%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluaranToko as $item)
                                    <tr id="tr_{{ $item->id }}">
                                        <th><input type="checkbox" data-id="{{ $item->id }}"
                                                class="form-check-input checkbox"></th>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ rupiah($item->total) }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                                        <td>
                                            <div class="btn-group btn-sm">
                                                <a href="{{ url('pengeluaran/' . $item->id . '/edit') }}">
                                                    <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pengeluaranToko->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @includeIf('users.modalForm')
    @includeIf('users.tambah')
    @includeIf('users.modalFormDetail')
    <!-- Table End -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            read();
            $('.alert').fadeOut(3000);


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
                                type: "DELETE",
                                url: "{{ url('pengeluaranhapusmultiple') }}/" + stuId,
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
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================
        function show(id) {
            $.get('{{ url('userShow') }}/' + id, {},
                function(data, status) {
                    $('#editUser').modal('show');
                    $('#page').html(data);
                },
            );
        }

        // ========================================================
        // ================ FUNGSI Update DATA ===============
        // ========================================================
        function update(id) {
            var nama = $('#nama').val();
            var email = $('#email').val();
            var level = $('#level').val();
            var password = $('#password').val();

            $.ajax({
                type: "get",
                url: "{{ url('userUpdate') }}/" + id,
                data: {
                    nama: nama,
                    email: email,
                    level: level,
                    password: password,
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
                        url: "{{ url('userHapus') }}/" + id,
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
