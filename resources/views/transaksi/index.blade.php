@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">{{ $title }}</h6>
                    <div class="table-responsive">
                        <div class="btn-group">
                            <a href="{{ route('transaksi.create') }}"><button class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"> </i>
                                    Tambah</button></a>
                            <button class="btn btn-danger btn-sm hapus-multiple"><i class="fa fa-trash"> </i> Hapus</button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkboxMain" class="form-check-input"></th>
                                    <th>No</th>
                                    <th>Diskon</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                    <th><i class="fa fa-gear"></i></th>
                                </tr>
                            </thead>
                            @foreach ($transaksi as $item)
                                <tbody class="text-capita3lize">
                                    <tr id="tr_{{ $item->id }}">
                                        <td><input type="checkbox" data-id="{{ $item->id }}"
                                                class="form-check-input checkbox"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->diskon }}</td>
                                        <td>{{ rupiah($item->total) }}</td>
                                        <td>
                                            @if ($item->status == 'selesai')
                                                <span class="badge bg-success">{{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-sm">
                                                <button class="btn btn-success"
                                                    onclick="detail({{ $item->transaksidetail->transaksi_id ?? '' }})"><i
                                                        class="fa fa-eye"></i></button>
                                                <button class="btn btn-danger" onclick="destroy({{ $item->id }})"><i
                                                        class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeIf('transaksi.modalFormDetail')
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#checkboxMain').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $('.checkbox').prop('checked', true);
                } else {
                    $('.checkbox').prop('checked', false);
                }
            });
            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').lenght == $('.checkbox').lenght) {
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
                                url: "{{ url('transaksihapusmultiple') }}/" + stuId,
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
        });

        // ========================================================
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================
        function show(id) {
            $.get('{{ url('transaksishow') }}/' + id, {},
                function(data, status) {
                    $('#modalForm').modal('show');
                    $('#modalFormLabel').text('Edit Data Produk');
                    $('#page').html(data);
                },
            );
        }

        function detail(id) {
            $.get('{{ url('detail-transaksi') }}/' + id, {},
                function(data, status) {
                    $('#modalFormDetail').modal('show');
                    $('#modalFormLabelDetail').text('Detail Data Transaksi');
                    $('#halaman').html(data);
                },
            );
        }
        // ========================================================
        // ================ FUNGSI DETAIL DATA ===============
        // ========================================================
    </script>
@endpush
