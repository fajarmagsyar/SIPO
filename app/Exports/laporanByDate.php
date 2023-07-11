<?php

namespace App\Exports;

use App\Invoice;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class laporanByDate implements FromView, ShouldAutoSize, WithStyles
{


    protected $dari;
    protected $hingga;

    function __construct($dari, $hingga)
    {
        $this->dari = date($dari);
        $this->hingga = date($hingga);
    }

    public function view(): View
    {
        $laporanQuery = Transaksi::select(['*', 'transaksi.keterangan as transaksi_keterangan', 'obat.keterangan as obat_keterangan'])
            ->join('batch', 'batch.batch_id', 'transaksi.batch_id')
            ->join('pelaku', 'pelaku.pelaku_id', 'transaksi.pelaku_id')
            ->join('obat', 'obat.obat_id', 'batch.obat_id')
            ->whereBetween('transaksi.created_at', [$this->dari, $this->hingga])
            ->get();
        return view('exports.laporan', [
            'laporan' => $laporanQuery
        ]);
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            'A1:Y1'    => [
                'font' => ['bold' => true],
            ], 'A2:Y2'    => [
                'font' => ['bold' => true],
            ],
        ];
    }
}
