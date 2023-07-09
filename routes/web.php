<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AdminController;
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
Route::get('/admin-pg', [HomeController::class, 'dashboard']);
Route::post('/auth', [HomeController::class, 'auth']);
Route::get('/admin-pg/log-activity', [HomeController::class, 'logActivity']);

Route::resource('/admin-pg/obat', ObatController::class);
Route::resource('/admin-pg/batch', BatchController::class);
Route::resource('/admin-pg/admin', AdminController::class);
Route::resource('/admin-pg/pelaku', PelakuController::class);
Route::resource('/admin-pg/transaksi', TransaksiController::class);
