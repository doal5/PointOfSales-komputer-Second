<?php

namespace App\Http\Controllers;

use App\Charts\bulanChart;
use App\Charts\harianChart;
use App\Models\transaksiDetail;
use App\Models\produk;
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
        $today = date('m');
        $start = new Carbon();
        $start->startOfMonth();
        $end = new Carbon();
        $end->endOfMonth()->toDateString();
        $days = [];


        // data harian
        $hari = transaksiDetail::whereBetween('tanggal', [$start, $end])->get();
        $arrhari = [];
        foreach ($hari as $value) {
            $arrhari[] = $value->subtotal;
        };
        $datahari = $arrhari;

        while ($start->lte($end)) {
            $days[] = $start->copy()->format('d');
            $start->addDay();
        }
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

        $labeltahun = [
            2024,
            2025,
            2026,
            2027,
            2028,
            2029,
            2030
        ];

        // label hari chart harian
        $labelhari = $days;

        // data tahuan
        $tahun = Carbon::now()->startOfYear()->toDateString();
        $thn = date('Y', strtotime($tahun));
        $datatahunan = transaksiDetail::whereYear('tanggal', [$thn])->sum('subtotal');

        $tahunini = [];
        $tahunini[] = $datatahunan;

        // Grafik Tahunan
        $tahunChart = (new LarapexChart)->setTitle('Penjualan Tahunan')
            ->setDataset($tahunini)
            ->setLabels($labeltahun);

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


        $mingguChart = (new LarapexChart)->setType('area')
            ->setTitle('Penjualan Mingguan')
            ->setXAxis($labelhari)
            ->setDataset([
                [
                    'name' => 'Pendapatan Mingguan',
                    'data' => [12, 23, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 34, 34, 34, 34, 34, 34, 34, 23]

                ]
            ])
            ->setHeight(300);

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

        $totalProduk = produk::count();
        return view('dashboard.index', ['harianChart' => $harianChart, 'bulanChart' => $bulanChart, 'mingguChart' => $mingguChart, 'tahunChart' => $tahunChart, 'totalProduk' => $totalProduk]);
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
