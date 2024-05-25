<?php

namespace App\Charts;

use App\Models\transaksiDetail;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class bulanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $tanggal = [
            $transaksi = transaksiDetail::whereMonth('tanggal', '1')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '2')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '3')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '4')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '5')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '6')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '7')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '8')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '9')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '10')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '11')->count(),
            $transaksi = transaksiDetail::whereMonth('tanggal', '12')->count()
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
        return $this->chart->barChart()
            ->setTitle('Penjualan Bulanan')
            ->setSubtitle('2024.')
            ->addData('Penjualan Unit', $tanggal)
            ->setXAxis($label);
    }
}
