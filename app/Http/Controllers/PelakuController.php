<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Pelaku;
use Illuminate\Http\Request;

class PelakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Master Pelaku',
            'data' => Pelaku::get(),
            'link' => 'pelaku',
        ];
        return view('pelaku.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Master Pelaku',
            'link' => 'pelaku',
        ];
        return view('pelaku.create', $data);
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
            'kode_pelaku' => $request->input('kode_pelaku'),
            'nama_pelaku' => $request->input('nama_pelaku'),
            'kemasan' => $request->input('kemasan'),
            'kategori' => $request->input('kategori'),
            'hak' => $request->input('hak'),
            'status' => $request->input('status'),
        ];

        $insert = Pelaku::create($post)
            ->getAttributes();

        //Isi Log
        $log = [
            'jenis' => 'Tambah Pelaku => ' . $post['kode_pelaku'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/pelaku')->with('success', 'Data berhasil ditambahkan');
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
        $data = [
            'title' => 'Edit Pelaku',
            'data' => Pelaku::find($id),
            'link' => 'pelaku',
        ];
        return view('pelaku.edit', $data);
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
            'kode_pelaku' => $request->input('kode_pelaku'),
            'nama_pelaku' => $request->input('nama_pelaku'),
            'kemasan' => $request->input('kemasan'),
            'kategori' => $request->input('kategori'),
            'hak' => $request->input('hak'),
            'status' => $request->input('status'),
        ];

        $insert = Pelaku::find($id)
            ->update($post);

        //Isi Log
        $log = [
            'jenis' => 'Ubah Pelaku => ' . $post['kode_pelaku'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/pelaku')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Pelaku::find($id);

        //Isi Log
        $log = [
            'jenis' => 'Hapus Pelaku => ' . $post['kode_pelaku'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        Pelaku::destroy($id);
        return redirect('/admin-pg/pelaku')->with('success', 'Data berhasil dihapus');
    }
}
