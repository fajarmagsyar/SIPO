<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Batch;
use App\Models\Obat;
use App\Models\Pelaku;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Transaksi',
            'link' => 'transaksi',
            'link_tambah' => '/admin-pg/transaksi/create',
            'data' => Transaksi::select(['pelaku.nama_pelaku', 'obat.nama_obat', 'obat.kode_obat', 'batch.no_batch', 'transaksi.*', 'admin.nama_admin'])
                ->join('batch', 'batch.batch_id', 'transaksi.batch_id')
                ->join('pelaku', 'pelaku.pelaku_id', 'transaksi.pelaku_id')
                ->join('obat', 'obat.obat_id', 'batch.obat_id')
                ->join('admin', 'admin.admin_id', 'transaksi.created_by')
                ->get(),
        ];
        return view('transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Transaksi',
            'link' => 'transaksi',
            'batch' => Batch::join('obat', 'obat.obat_id', 'batch.obat_id')->get(),
            'pelaku' => Pelaku::get(),
            'linkPost' => '/admin-pg/transaksi/'
        ];
        return view('transaksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = [
            'batch_id' => $request->input('batch_id'),
            'pelaku_id' => $request->input('pelaku_id'),
            'detail' => $request->input('detail'),
            'jenis' => $request->input('jenis'),
            'keterangan' => $request->input('keterangan'),
            'jumlah' => $request->input('jumlah'),
            'created_by' => auth()->user()->admin_id,
        ];

        $batch = Batch::where('batch_id', $request->input('batch_id'))->first();
        $obat = Obat::find($batch->obat_id);
        $stok = $obat->stok_saat_ini;

        if ($request->input('jenis') == 'Masuk') {
            $stok = $stok +  $request->input('jumlah');
            $obat->update(['stok_saat_ini' => $stok]);
        } else {
            $stok = $stok -  $request->input('jumlah');
            $obat->update(['stok_saat_ini' => $stok]);
        }

        $insert = Transaksi::create($post)
            ->getAttributes();

        //Isi Log
        $log = [
            'jenis' => 'Tambah Transaksi => ' . $post['jumlah'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/transaksi')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
