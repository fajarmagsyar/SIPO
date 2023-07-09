<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Master Admin',
            'data' => Admin::get(),
            'link' => 'admin',
        ];
        return view('admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Master Admin',
            'link' => 'admin',
        ];
        return view('admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $post = [
            'nama_admin' => $request->input('nama_admin'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ];

        //Bagian penamaan file
        $doc_name = 'admin/' . 'admin-' . date('Y-m-d_H-i-s') . rand(0, 100000) . '.' . $request->file('img')->getClientOriginalExtension();

        $post['img'] = $doc_name;

        //Pemindahan file
        $request->file('img')->move(public_path('admin'), $doc_name);
        $insert = Admin::create($post)
            ->getAttributes();

        //Isi Log
        $log = [
            'jenis' => 'Tambah Admin => ' . $post['nama_admin'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/admin')->with('success', 'Data berhasil ditambahkan');
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
            'title' => 'Edit Admin',
            'data' => Admin::find($id),
            'link' => 'admin',
        ];
        return view('admin.edit', $data);
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
            'nama_admin' => $request->input('nama_admin'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ];

        if ($request->input('password')) {
            $post['password'] = $request->input('password');
        }

        if ($request->file('img')) {
            //Bagian penamaan file
            $doc_name = 'admin/' . 'admin-' . date('Y-m-d_H-i-s') . rand(0, 100000) . '.' . $request->file('img')->getClientOriginalExtension();
            $post['img'] = $doc_name;
            //Pemindahan file
            $request->file('img')->move(public_path('admin'), $doc_name);
        }

        $insert = Admin::find($id)
            ->update($post);

        //Isi Log
        $log = [
            'jenis' => 'Ubah Admin => ' . $post['nama_admin'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/admin')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = [
            'nama_admin' => $request->input('nama_admin'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ];

        Admin::destroy($id);

        //Isi Log
        $log = [
            'jenis' => 'Hapus Admin => ' . $post['nama_admin'],
            'detail' => "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'],
            'admin_id' => auth()->user()->admin_id,
        ];
        LogActivity::create($log);

        return redirect('/admin-pg/admin')->with('success', 'Data berhasil dihapus');
    }
}
