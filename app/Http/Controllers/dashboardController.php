<?php

namespace App\Http\Controllers;

use App\Charts\bulanChart;
use App\Charts\harianChart;
use App\Models\transaksiDetail;
use App\Models\produk;
use App\Models\transaksi;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart as FacadesLarapexChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
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
            $arrhari[] = $value->subtotal;
        };
        $datahari = $arrhari;
        // end data harian

        // Data Bulanan


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

        // data mingguan
        $awalBulan = Carbon::now()->startOfMonth()->toDateString();
        $akhirBulan = Carbon::now()->endOfMonth()->toDateString();

        $mingguan = transaksiDetail::whereBetween('tanggal', [$awalBulan, $akhirBulan])
            ->selectRaw('YEARWEEK(tanggal,4) as week, SUM(subtotal) as subtotal')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        $dtMinggu = [];
        foreach ($mingguan as $minggu) {
            $dataminggu = $minggu->subtotal;
            $dtMinggu[] = $dataminggu;
        }

        // jumlah minggu
        $labelMinggu = [
            'Minggu Ke 1',
            'Minggu Ke 2',
            'Minggu Ke 3',
            'Minggu Ke 4',
        ];
        // end data minggu

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

        // Grafik chart harian
        $harianChart = (new LarapexChart)->setType('area')
            ->setTitle('Penjualan Harian')
            ->setXAxis($labelhari)
            ->setDataset([
                [
                    'name' => 'Pendapatan Harian',
                    'data' => $datahari

                ]
            ])
            ->setHeight(300);

        // Grafik chart mingguan
        $mingguChart = (new LarapexChart)->setType('pie')
            ->setTitle('Penjualan Mingguan')
            ->setDataset($dtMinggu)
            ->setLabels($labelMinggu)
            ->setHeight(310);

        // Grafik Tahunan
        $tahunChart = (new LarapexChart)->setTitle('Penjualan Tahunan')
            ->setDataset($tahunini)
            ->setLabels($labeltahun)
            ->setHeight(310);


        // grafik chart bulanan
        $bulanChart = (new LarapexChart)->setType('bar')
            ->setTitle('Penjualan Bulanan')
            ->setXAxis($label)
            ->setDataset([
                [
                    'name'  =>  'Pendapatan bulanan',
                    'data'  =>  [
                        transaksiDetail::whereMonth('tanggal', '1')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '2')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '3')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '4')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '5')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '6')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '7')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '8')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '9')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '10')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '11')->sum('subtotal'),
                        transaksiDetail::whereMonth('tanggal', '12')->sum('subtotal')
                    ]
                ]
            ])
            ->setHeight(300);
        $hariniPenjualan = Carbon::now()->toDateString();
        $totalProduk = produk::count();
        $totalPenjualan = transaksi::sum('total');
        $penjualanHari = transaksi::whereDate('tanggal', $hariniPenjualan)->sum('total');

        $data = [
            'totalProduk' => $totalProduk,
            'totalPenjualan' => $totalPenjualan,
            'penjualanHari' => $penjualanHari
        ];

        return view('dashboard.index', $data, ['harianChart' => $harianChart, 'bulanChart' => $bulanChart, 'mingguChart' => $mingguChart, 'tahunChart' => $tahunChart, 'totalProduk' => $totalProduk]);
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
