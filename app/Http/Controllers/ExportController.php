<?php

namespace App\Http\Controllers;

use App\Exports\laporanAll;
use App\Exports\laporanByDate;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan',
            'link' => 'laporan',
        ];
        return view('laporan', $data);
    }
    public function laporan()
    {
        $export = Excel::download(new laporanAll, 'SIPO_LAPORAN_ALLTIME.xlsx');
        ob_end_clean();

        return $export;
    }
    public function laporanByDate(Request $request)
    {
        $dari = $request->get('dari');
        $hingga = $request->get('hingga');
        $export = Excel::download(new laporanByDate($dari, $hingga), 'SIPO_lAPORAN_' . $dari . '-' . $hingga . '.xlsx');
        ob_end_clean();

        return $export;
    }
}
