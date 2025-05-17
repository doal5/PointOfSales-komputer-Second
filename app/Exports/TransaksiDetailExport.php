<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\TransaksiDetail;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class TransaksiDetailExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $runningTotal = 0;

        return transaksiDetail::with('produk')->get()->map(function ($item) use (&$runningTotal) {
            $subtotal = $item->subtotal;
            $runningTotal += $subtotal;

            return [
                'Kode Produk' => $item->produk->kode_produk ?? '-',
                'Produk' => $item->produk->produk ?? '-',
                'Qty' => $item->qty,
                'Subtotal' => $subtotal,
                'Running Total' => $runningTotal,
                'Tanggal' => date('d F Y', strtotime($item->tanggal)),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Produk',
            'Produk',
            'Qty',
            'Total amount',
            'Total',
            'Tanggal',
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function title(): string
    {
        return 'Laporan Transaksi';
    }

    public function styles(Worksheet $sheet)
    {
        // Tambahkan header laporan dengan tanggal sekarang
        $sheet->setCellValue('A1', 'Laporan Saat Ini (' . Carbon::now()->format('d F Y') . ')');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getRowDimension(1)->setRowHeight(30);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center');

        return [];
    }
}
