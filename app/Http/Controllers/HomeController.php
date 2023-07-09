<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Batch;
use App\Models\LogActivity;
use App\Models\Obat;
use App\Models\Pelaku;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'link' => 'dashboard',
            'obat' => Obat::count(),
            'pelaku' => Pelaku::count(),
            'batch' => Batch::count(),
            'transaksi' => Transaksi::count(),
        ];
        return view('dashboard', $data);
    }
    public function gantiPassword(Request $request)
    {
        $pass_lama = $request->input('password_lama');
        // dd($pass_lama);
        $admin = Admin::find(auth()->user()->admin_id);

        $check = Hash::check($pass_lama, $admin->password);
        if ($check) {
            $admin->update(['password' => Hash::make($request->input('password'))]);
            return redirect('/admin-pg/akun-saya/' . $admin->admin_id)->with('success', 'Password berhasil diganti');
        }
        return redirect('/admin-pg/akun-saya/' . $admin->admin_id)->with('error', 'Password lama anda salah');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function auth(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $admin = Admin::where('email', $request->input('email'))->first();
            if ($admin->first_login != null) {
                $log['first_login'] = Carbon::now();
            }
            $log['last_login'] = Carbon::now();
            $log['last_login_detail'] = "<strong>Device : <br></strong>" . $_SERVER['HTTP_USER_AGENT'] . "<br><strong>IP Address :</strong> " . $_SERVER['REMOTE_ADDR'];
            $admin->update($log);

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
            'data' => LogActivity::select(['admin.email', 'admin.nama_admin', 'admin.no_hp', 'log_activity.*', 'admin.img'])
                ->join('admin', 'admin.admin_id', 'log_activity.admin_id')
                ->orderBy('log_activity.created_at', 'DESC')
                ->get(),
        ];
        return view('log', $data);
    }

    public function logActivityByID($id)
    {
        $data = [
            'title' => 'Log Activity',
            'link' => 'log',
            'data' => LogActivity::select(['admin.email', 'admin.nama_admin', 'admin.no_hp', 'log_activity.*'])
                ->join('admin', 'admin.admin_id', 'log_activity.admin_id')
                ->where('admin.admin_id', $id)
                ->get(),
        ];
        return view('log', $data);
    }
    public function akunSaya()
    {
        $data = [
            'title' => 'Akun Saya',
            'link' => 'akunasya',
            'data' => Admin::find(auth()->user()->admin_id),
            'log' => LogActivity::where('admin_id', auth()->user()->admin_id)->limit(10)->orderBy('created_at', 'DESC')->get(),
        ];
        return view('akun-saya', $data);
    }
}
