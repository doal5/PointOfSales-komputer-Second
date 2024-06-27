<?php

namespace App\Exports;

use App\Models\transaksiDetail;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class analisisExport implements FromView
{
    public function view(): View
    {
        $year = Carbon::now()->year;
        $pt = transaksiDetail::select(
            'id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold'),
        )
            ->whereYear('tanggal', $year)
            ->groupBy('id_produk')
            ->orderBy('total', 'desc')
            ->take(5)
            ->with('produk')
            ->get();

        return view('analisis.cetak', [
            'pt' => $pt
        ]);
    }
}
