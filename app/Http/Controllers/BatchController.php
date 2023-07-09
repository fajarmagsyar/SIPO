<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Batch;
use App\Models\Obat;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Master Batch',
            'link' => 'batch',
            'link_tambah' => '/admin-pg/batch/create',
            'data' =>  $request->query('obat') !== null ?  Batch::where('batch.obat_id', $request->query('obat'))->join('obat', 'obat.obat_id', 'batch.obat_id')->get() : Batch::join('obat', 'obat.obat_id', '=', 'batch.obat_id')->get(),
        ];
        return view('batch.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'title' => 'Master Batch',
            'link' => 'batch',
            'obat' => Obat::get(),
            'linkPost' => '/admin-pg/batch/',
            'obat_id' => $request->query('id') !== null ? $request->query('id') : '',
        ];
        return view('batch.create', $data);
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
            'no_batch' => $request->input('no_batch'),
            'obat_id' => $request->input('obat_id'),
            'kadaluarsa' => $request->input('kadaluarsa'),
        ];

        $insert = Batch::create($post)
            ->getAttributes();

        //Isi Log
        $log = [
            'jenis' => 'Tambah Batch => ' . $post['no_batch'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/batch')->with('success', 'Data berhasil ditambahkan');
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
        $batch = Batch::find($id);
        $obat = Obat::find($batch->obat_id);
        $data = [
            'title' => 'Edit Master Batch',
            'link' => 'batch',
            'data' => $batch,
            'obat' => $obat,
            'linkPost' => '/admin-pg/batch/' . $batch->batch_id
        ];
        return view('batch.edit', $data);
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
        $post = [
            'no_batch' => $request->input('no_batch'),
            'kadaluarsa' => $request->input('kadaluarsa'),
        ];

        $insert = Batch::find($id)
            ->update($post);

        //Isi Log
        $log = [
            'jenis' => 'Ubah Batch => ' . $post['no_batch'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/batch')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Batch::find($id);

        //Isi Log
        $log = [
            'jenis' => 'Hapus Batch => ' . $post['no_batch'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        Batch::destroy($id);
        return redirect('/admin-pg/batch')->with('success', 'Data berhasil dihapus');
    }
}
