<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'link' => 'dashboard'
        ];
        return view('dashboard', $data);
    }
    public function auth(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/admin-pg');
        }

        return back()->with(
            'error',
            'Password atau email anda salah',
        );
    }

    public function logActivity()
    {
        $data = [
            'title' => 'Log Activity',
            'link' => 'log',
            'data' => LogActivity::join('admin', 'admin.admin_id', 'log_activity.admin_id')
                ->get(),
        ];
        // dd($data);
        return view('log', $data);
    }
}
