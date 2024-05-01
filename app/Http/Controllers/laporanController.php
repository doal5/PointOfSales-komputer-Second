<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\transaksiDetail;
use Illuminate\Http\Request;

class laporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tglawal = request('tanggalawal');
        $tglakhir = request('tanggalakhir');

        $transaksi = transaksiDetail::whereBetween('tanggal', [$tglawal, $tglakhir])->with('produk', 'transaksi')->get();

        $data = [
            'i' => 1,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
            'transaksi' => $transaksi,
        ];

        return view('laporan.index', $data);
    }


    public function cetak()
    {
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
