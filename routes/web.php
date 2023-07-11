<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PelakuController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'signIn']);
Route::get('/admin-pg', [HomeController::class, 'dashboard'])->middleware(['check']);
Route::post('/auth', [HomeController::class, 'auth']);
Route::get('/logout', [HomeController::class, 'logout']);
Route::post('/ganti-password', [HomeController::class, 'gantiPassword'])->middleware(['check']);
Route::get('/admin-pg/log-activity', [HomeController::class, 'logActivity'])->middleware(['check']);
Route::get('/admin-pg/log-activity/{id}', [HomeController::class, 'logActivityById'])->middleware(['check']);
Route::get('/admin-pg/akun-saya/{id}', [HomeController::class, 'akunSaya'])->middleware(['check']);

//resources
Route::resource('/admin-pg/obat', ObatController::class)->middleware(['check']);
Route::resource('/admin-pg/batch', BatchController::class)->middleware(['check']);
Route::resource('/admin-pg/admin', AdminController::class)->middleware(['check']);
Route::resource('/admin-pg/pelaku', PelakuController::class)->middleware(['check']);
Route::resource('/admin-pg/transaksi', TransaksiController::class)->middleware(['check']);

//excel export
Route::get('/admin-pg/laporan/export', [ExportController::class, 'laporan'])->middleware(['check']);
Route::get('/admin-pg/laporan/export/query', [ExportController::class, 'laporanByDate'])->middleware(['check']);
Route::get('/admin-pg/laporan', [ExportController::class, 'index'])->middleware(['check']);
