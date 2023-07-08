<?php

namespace App\Http\Controllers;

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
        Pelaku::destroy($id);
        return redirect('/admin-pg/pelaku')->with('success', 'Data berhasil dihapus');
    }
}
