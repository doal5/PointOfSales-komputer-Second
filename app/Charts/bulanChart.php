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
        return $this->chart->barChart()
            ->setTitle('Penjualan Bulanan')
            ->setSubtitle('2024.')
            ->addData('Total Penjualan',  $tanggal)
            ->setXAxis($label);
    }
}
