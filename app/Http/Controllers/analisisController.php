<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\transaksi;
use App\Charts\bulanChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\analisisExport;
use App\Models\transaksiDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Charts\penjualanbulananChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class analisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // data harian
        $today = date('m');
        $start = new Carbon();
        $start->startOfMonth();
        $end = new Carbon();
        $end->endOfMonth()->toDateString();
        $days = [];

        $hari = transaksiDetail::whereBetween('tanggal', [$start, $end])->get();
        $arrhari = [];
        foreach ($hari as $value) {
            $arrhari[] = $value->qty;
        };
        $datahari = $arrhari;
        // end data harian

        // Label bulanan chart
        $label = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        // end data bulanan

        // label hari chart harian
        $labelhari = $days;

        // Ambil tanggal awal dan akhir untuk 3 bulan terakhir
        $awalBulan = Carbon::now()->subMonths(3)->startOfMonth(); // Awal 3 bulan lalu
        $akhirBulan = Carbon::now()->endOfMonth(); // Akhir bulan ini

        // Ambil data penjualan berdasarkan produk selama 3 bulan terakhir
        $transaksi3bulan = transaksiDetail::with('produk')
            ->select('id_produk', DB::raw('SUM(qty) as total_terjual'))
            ->whereBetween('tanggal', [$awalBulan, $akhirBulan])
            ->groupBy('id_produk')
            ->get();

        // Label produk berdasarkan nama produk
        $labelProduk3bulan = $transaksi3bulan->map(function ($item) {
            return $item->produk->produk; // Nama produk melalui relasi
        })->toArray();

        // Data jumlah penjualan setiap produk
        $dataPenjualan3bulan = $transaksi3bulan->pluck('total_terjual')->toArray();

        // Membuat grafik pie chart untuk penjualan 3 bulan
        $bulan3Chart = (new LarapexChart)->pieChart()
            ->setTitle('Penjualan 3 Bulan Terakhir')
            ->setDataset($dataPenjualan3bulan) // Data jumlah terjual
            ->setLabels($labelProduk3bulan) // Nama produk sebagai label
            ->setHeight(310); // Atur tinggi grafik


        // data tahuan
        $tahun = Carbon::now()->startOfYear()->toDateString();
        $thn = date('Y', strtotime($tahun));
        $datatahunan = transaksiDetail::whereYear('tanggal', [$thn])->sum('subtotal');

        $tahunini = [];
        $tahunini[] = $datatahunan;

        $labeltahun = [
            2024,
            2025,
            2026,
            2027,
            2028,
            2029,
            2030
        ];
        // end data tahun

        while ($start->lte($end)) {
            $days[] = $start->copy()->format('d');
            $start->addDay();
        }

        // Ambil tanggal awal bulan
        $start1bulan = Carbon::now()->startOfMonth();

        // Ambil data transaksi selama 1 bulan terakhir
        $transaksi1bulan = transaksiDetail::with('produk')
            ->select('id_produk', DB::raw('SUM(qty) as total_terjual'))
            ->where('tanggal', '>=', $start1bulan)
            ->groupBy('id_produk')
            ->get();

        // Label produk berdasarkan nama produk
        $labelprodukbulan = $transaksi1bulan->map(function ($item) {
            return $item->produk->produk; // Asumsi relasi `produk` ada
        })->toArray();

        // Data jumlah penjualan setiap produk
        $dataPenjualan = $transaksi1bulan->pluck('total_terjual')->toArray();

        // Membuat grafik horizontal bar chart
        $bulanChart = (new LarapexChart)->horizontalBarChart()
            ->setTitle('Penjualan 1 Bulan - ' . Carbon::now()->format('F Y')) // Tambahkan bulan & tahun pada judul
            ->setLabels($labelprodukbulan) // Produk sebagai label di sumbu Y
            ->addData('Penjualan 1 Bulan', $dataPenjualan) // Data jumlah terjual
            ->setHeight(300); // Atur tinggi grafik





        // Ambil data transaksi untuk setiap tahun
        $transaksitahun = transaksiDetail::with('produk')
            ->select(
                'id_produk',
                DB::raw('YEAR(tanggal) as tahun'),
                DB::raw('SUM(qty) as total_terjual')
            )
            ->whereIn(DB::raw('YEAR(tanggal)'), $labeltahun) // Filter tahun
            ->groupBy('id_produk', 'tahun')
            ->get();

        $yAxisLabels = $labeltahun;
        $start6bulan = Carbon::now()->subMonth(6);
        $transaksi6bulan = transaksiDetail::with('produk')
            ->select('id_produk', DB::raw('SUM(qty) as total_terjual'))
            ->where('tanggal', '>=', $start6bulan)
            ->groupBy('id_produk')
            ->get();
        $labelproduk = $transaksi6bulan->map(function ($item) {
            return $item->produk->produk;
        })->toArray();

        // Tahun ini
        $tahunIni = Carbon::now()->year;

        // Ambil data penjualan tahunan berdasarkan produk
        $transaksiTahunan = transaksiDetail::with('produk')
            ->select('id_produk', DB::raw('SUM(qty) as total_terjual'))
            ->whereYear('tanggal', $tahunIni) // Filter untuk tahun ini
            ->groupBy('id_produk')
            ->get();

        // Label produk berdasarkan nama produk
        $labelProdukTahunan = $transaksiTahunan->map(function ($item) {
            return $item->produk->produk; // Nama produk melalui relasi
        })->toArray();

        // Data jumlah penjualan setiap produk
        $dataPenjualanTahunan = $transaksiTahunan->pluck('total_terjual')->toArray();

        // Membuat grafik horizontal bar chart
        $tahunChart = (new LarapexChart)->horizontalBarChart()
            ->setTitle('Penjualan Tahun ' . $tahunIni) // Judul dinamis berdasarkan tahun
            ->setLabels($labelProdukTahunan) // Nama produk sebagai label di sumbu Y
            ->addData('Jumlah Terjual', $dataPenjualanTahunan) // Data jumlah terjual di sumbu X
            ->setHeight(310) // Tinggi grafik
            ->setColors(['#FF5733', '#33FF57', '#3357FF']); // Warna bar


        $data6bulan = $transaksi6bulan->map(function ($item) {
            return $item->total_terjual;
        })->toArray();

        // grafik chart bulanan
        $bulan6Chart = (new LarapexChart)->horizontalBarChart()
            ->setTitle('Penjualan 6 Bulan')
            ->setXAxis($labelproduk)
            ->addData('Jumlah Terjual', $data6bulan)
            ->setHeight(300);


        // total penjualan untuk box dashboard
        $hariniPenjualan = Carbon::now()->toDateString();
        $totalProduk = produk::count();
        $totalPenjualan = transaksi::sum('total');
        $penjualanHari = transaksi::whereDate('tanggal', $hariniPenjualan)->sum('total');


        $year = Carbon::now()->year;
        $ptS = transaksiDetail::select(
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

        $ptK = transaksiDetail::select(
            'transaksi_detail.id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold')
        )
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->whereYear('tanggal', $year)
            ->where('produk.kategori_id', 4)
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

        $ptLaptop = transaksiDetail::select(
            'transaksi_detail.id_produk',
            DB::raw('sum(qty) as total'),
            DB::raw('MAX(tanggal) as last_sold')
        )
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->whereYear('tanggal', $year)
            ->where('produk.kategori_id', 3)
            ->groupBy('id_produk')
            ->orderBy('total', 'desc')
            ->take(5)
            ->with('produk')
            ->get();

        $data = [
            'ptS' => $ptS,
            'ptK' => $ptK,
            'ptL' => $ptL,
            'ptLaptop' => $ptLaptop,
            'totalProduk' => $totalProduk,
            'totalPenjualan' => $totalPenjualan,
            'penjualanHari' => $penjualanHari,
            'bulanChart' => $bulanChart,
            'bulan6Chart' => $bulan6Chart,
            'bulan3Chart' => $bulan3Chart,
            'tahunChart' => $tahunChart,
            'totalProduk' => $totalProduk
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

    public function cetak($kategori)
    {
        return Excel::download(new analisisExport($kategori), 'analisis.xlsx');
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
