<?php

namespace App\Exports;

use App\Models\transaksiDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class laporanExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $tglawal, $tglakhir, $total;
    // ngambil parameter tanggal awal akhir yang dikirim
    public function __construct($tglawal, $tglakhir, $total)
    {

        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
        $this->total = $total;
    }

    public function view(): View
    {
        $transaksi = transaksiDetail::whereBetween('tanggal', [$this->tglawal, $this->tglakhir])->with('produk', 'transaksi2')->get();
        return view('laporan.laporan', [
            'transaksi' => $transaksi,
            'tglawal' => $this->tglawal,
            'tglakhir' => $this->tglakhir,
            'total' => $this->total
        ]);
    }
}
