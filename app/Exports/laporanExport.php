<?php

namespace App\Exports;

use App\Models\pengeluaran;
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
    protected $tglawal, $tglakhir, $total, $totalPengeluaran;
    // ngambil parameter tanggal awal akhir yang dikirim
    public function __construct($tglawal, $tglakhir, $total, $totalPengeluaran)
    {

        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
        $this->total = $total;
        $this->totalPengeluaran = $totalPengeluaran;
    }

    public function view(): View
    {
        $transaksi = transaksiDetail::whereBetween('tanggal', [$this->tglawal, $this->tglakhir])->with('produk', 'transaksi2')->get();
        $pengeluaran = pengeluaran::whereBetween('tanggal', [$this->tglawal, $this->tglakhir])->where('total', '>', 0)->get();
        $totalKeuntungan = $transaksi->groupBy('id_produk')->map(function ($items) {
            return $items->sum(function ($item) {
                if ($item->produk) {
                    $hargaBeli = $item->produk->harga_beli;
                    $hargaJual = $item->produk->harga_jual;
                    return ($hargaJual - $hargaBeli) * $item->qty;
                }
                return 'tidak ada';
            });
        })->sum();
        $totalPengeluaran = $this->totalPengeluaran; // total pengeluaran dari controller
        $totalKeuntunganBersih = $totalKeuntungan - $totalPengeluaran;

        return view('laporan.laporan', [
            'transaksi' => $transaksi,
            'tglawal' => $this->tglawal,
            'tglakhir' => $this->tglakhir,
            'total' => $this->total,
            'totalPengeluaran' => $this->totalPengeluaran,
            'totalKeuntunganBersih' => $totalKeuntunganBersih,
            'pengeluaran' => $pengeluaran,

        ]);
    }
}
