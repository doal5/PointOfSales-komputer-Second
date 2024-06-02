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
        date_default_timezone_set('Asia/Jakarta');
        $today = date('m');

        $harian = [
            $hari = transaksiDetail::whereMonth('tanggal', $today)->where('subtotal')->get()
        ];


        $tanggal = [
            $transaksi = transaksiDetail::whereMonth('tanggal', '1')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '2')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '3')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '4')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '5')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '6')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '7')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '8')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '9')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '10')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '11')->sum('subtotal'),
            $transaksi = transaksiDetail::whereMonth('tanggal', '12')->sum('subtotal')
        ];

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
        $labelhari = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Junat',
            'Sabtu',
            'Minggu'
        ];

        $harianChart = (new LarapexChart)->setType('line')
            ->setTitle('Penjualan Harian')
            ->setXAxis($labelhari)
            ->setDataset([
                [
                    'name'  =>  'Pendapatan harian',
                    'data'  =>  $harian
                ]
            ])
            ->setHeight(300);

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


        // $bulanChart = new LarapexChart;
        // $bulanChart->setType('bar');
        // $bulanChart->setTitle('penjualan bulanan');
        // $bulanChart->setDataset([
        //     23, 33
        // ]);
        // $bulanChart->setXAxis([
        //     'januari',
        //     'februari'
        // ]);
        // $bulanChart->setWidth(492);

        // $bulanChart = (new LarapexChart)->setType('bar')
        //     ->setTitle('Penjualan Bulanan')
        //     ->setDataset(
        //         $tanggal
        //     )
        //     ->setLabels($label);

        $totalProduk = produk::count();
        return view('dashboard.index', ['harianChart' => $harianChart, 'bulanChart' => $bulanChart, 'totalProduk' => $totalProduk]);
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
