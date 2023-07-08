<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function signIn()
    {
        return view('sign-in');
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('dashboard', $data);
    }
    public function obatPage()
    {
        $data = [
            'title' => 'Master Obat',
        ];
        return view('obat', $data);
    }
}
