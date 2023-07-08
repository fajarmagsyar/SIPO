<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Master Obat',
            'data' => Obat::get(),
        ];
        return view('obat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Master Obat',
        ];
        return view('obat.create', $data);
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
            'kode_obat' => $request->input('kode_obat'),
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'stok_awal' => $request->input('stok_awal'),
            'stok_saat_ini' => $request->input('stok_awal'),
            'hjd' => $request->input('hjd'),
            'keterangan' => $request->input('keterangan'),
        ];

        $insert = Obat::create($post)
            ->getAttributes();

        return redirect('/admin-pg/batch?id=' . $insert['obat_id'])->with('success', 'Data berhasil ditambahkan');
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
            'title' => 'Edit Obat',
            'data' => Obat::find($id),
        ];
        return view('obat.edit', $data);
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
            'kode_obat' => $request->input('kode_obat'),
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'hjd' => $request->input('hjd'),
            'keterangan' => $request->input('keterangan'),
        ];

        $insert = Obat::find($id)
            ->update($post);

        return redirect('/admin-pg/obat')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Obat::destroy($id);
        return redirect('/admin-pg/obat')->with('success', 'Data berhasil dihapus');
    }
}
