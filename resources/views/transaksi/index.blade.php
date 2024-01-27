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
                                <th>No</th>
                                <th>User ID</th>
                                <th>Kasir</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
