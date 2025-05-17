<?php

namespace App\Http\Controllers;

use App\Exports\laporanExport;
use App\Models\pengeluaran;
use App\Models\transaksi;
use App\Models\transaksiDetail;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class laporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tglawal = request('tanggalawal');
        $tglakhir = request('tanggalakhir');

        $transaksi = transaksiDetail::whereBetween('tanggal', [$tglawal, $tglakhir])->with('produk', 'transaksi2')->get();
        $pengeluaran = pengeluaran::whereBetween('tanggal', [$tglawal, $tglakhir])->where('total', '>', 0)->get();

        // $totalSalesPerDay = $transaksi->groupBy(function ($item) {
        //     return $item->tanggal;
        // })->map(function ($day) {
        //     return $day->sum(function ($item) {
        //         return $item->amount;
        //     });
        // });

        $tDetail = transaksiDetail::with('produk')->paginate('15');

        $transaksiDetails = transaksiDetail::whereBetween('tanggal', [$tglawal, $tglakhir])
            ->with('produk')
            ->get();

        // Hitung total penjualan per hari
        $totalPenjualanPerHari = $transaksiDetails->groupBy(function ($item) {
            return Carbon::parse($item->tanggal); // Kelompokkan berdasarkan tanggal
        })->map(function ($hari) {
            return $hari->sum('jumlah'); // Asumsikan 'jumlah' adalah kolom yang mewakili jumlah penjualan
        });

        // Hitung total keuntungan per produk
        // Hitung total keuntungan per produk
        $totalKeuntungan = $transaksiDetails->groupBy('id_produk')->map(function ($items) {
            return $items->sum(function ($item) {
                if ($item->produk) {
                    $hargaBeli = $item->produk->harga_beli;
                    $hargaJual = $item->produk->harga_jual;
                    return ($hargaJual - $hargaBeli) * $item->qty;
                }
                return 'tidak ada';
            });
        })->sum();



        // Hitung total pengeluaran
        $totalPengeluaran = pengeluaran::whereBetween('tanggal', [$tglawal, $tglakhir])->sum('total');

        // Hitung total keuntungan bersih
        $totalKeuntunganBersih = $totalKeuntungan - $totalPengeluaran;

        // Tampilkan data dan total penjualan per hari

        // Calculate total sales
        $total = transaksiDetail::whereBetween('tanggal', [$tglawal, $tglakhir])->sum('subtotal');
        $totalPengeluaran = pengeluaran::whereBetween('tanggal', [$tglawal, $tglakhir])->sum('total');

        $data = [
            'i' => 1,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
            'transaksi' => $transaksi,
            'total' => $total,
            'totalPengeluaran' => $totalPengeluaran,
            'totalKeuntungan' => $totalKeuntungan,
            'totalKeuntunganBersih' => $totalKeuntunganBersih,
            'pengeluaran' => $pengeluaran,
            'tDetail' => $tDetail
        ];

        return view('laporan.index', $data);
    }


    public function cetak($tglawal, $tglakhir, $total, $totalPengeluaran)
    {
        $filename = date('d-m-Y-h:i:s');
        return Excel::download(new laporanExport($tglawal, $tglakhir, $total, $totalPengeluaran), 'laporan-' . $filename . '.xlsx');
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
