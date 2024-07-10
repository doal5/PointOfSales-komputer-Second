<?php

namespace App\Http\Controllers;

use App\Charts\bulanChart;
use App\Charts\penjualanbulananChart;
use App\Exports\analisisExport;
use App\Models\transaksiDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class analisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $year = Carbon::now()->year;
        $ptS = transaksiDetail::select(
            'transaksi_detail.id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold')
        )
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->whereYear('tanggal', $year)
            ->where('produk.kategori_id', 9)
            ->groupBy('id_produk')
            ->orderBy('total', 'desc')
            ->take(5)
            ->with('produk')
            ->get();

        $ptK = transaksiDetail::select(
            'transaksi_detail.id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold')
        )
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->whereYear('tanggal', $year)
            ->where('produk.kategori_id', 2)
            ->groupBy('id_produk')
            ->orderBy('total', 'desc')
            ->take(5)
            ->with('produk')
            ->get();

        $ptL = transaksiDetail::select(
            'transaksi_detail.id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold')
        )
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->whereYear('tanggal', $year)
            ->where('produk.kategori_id', 1)
            ->groupBy('id_produk')
            ->orderBy('total', 'desc')
            ->take(5)
            ->with('produk')
            ->get();

        $data = [
            'ptS' => $ptS,
            'ptK' => $ptK,
            'ptL' => $ptL,
        ];
        return view('analisis.index', $data, compact('year'));
    }

    public function read()
    {
        $year = Carbon::now()->year;
        $ptS = transaksiDetail::select(
            'transaksi_detail.id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold')
        )
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->whereYear('tanggal', $year)
            ->where('produk.kategori_id', 9)
            ->groupBy('id_produk')
            ->orderBy('total', 'desc')
            ->take(5)
            ->with('produk')
            ->get();
        $ptK = transaksiDetail::select(
            'transaksi_detail.id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold')
        )
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->whereYear('tanggal', $year)
            ->where('produk.kategori_id', 9)
            ->groupBy('id_produk')
            ->orderBy('total', 'desc')
            ->take(5)
            ->with('produk')
            ->get();

        $data = [
            'ptS' => $ptS,
            'ptK' => $ptK,
        ];
        return view('analisis.read', $data);
    }

    public function cetak()
    {
        return Excel::download(new analisisExport, 'analisis.xlsx');
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
