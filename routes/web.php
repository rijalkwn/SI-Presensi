<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PresensiIzinController;
use App\Http\Controllers\PresensiMasukController;
use App\Http\Controllers\PresensiSakitController;
use App\Http\Controllers\PresensiPulangController;

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
//login 
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//register
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

//karyawan
Route::get('/karyawan/{{ $karyawan->nip }}/edit', [KaryawanController::class, 'edit'])->name('karyawan');
Route::resource('/karyawan', KaryawanController::class)->names('karyawan');


//jabatan
Route::get('/jabatan/{{ $jabatan->id }}/edit', [JabatanController::class, 'edit']);
Route::resource('/jabatan', JabatanController::class)->names('jabatan');

// //jabatan
// Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan');
// Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');


//PRESENSI
//masuk
Route::get('/masuk', [PresensiMasukController::class, 'create'])->name('presensi.masuk');
Route::post('/masuk', [PresensiMasukController::class, 'store'])->name('presensi.masuk.store');

//pulang
Route::get('/pulang', [PresensiPulangController::class, 'create'])->name('presensi.pulang');
Route::post('/pulang', [PresensiPulangController::class, 'store'])->name('presensi.pulang.store');

//izin
Route::get('/izin', [PresensiIzinController::class, 'create'])->name('presensi.izin');
Route::post('/izin', [PresensiIzinController::class, 'store'])->name('presensi.izin.store');

//sakit
Route::get('/sakit', [PresensiSakitController::class, 'create'])->name('presensi.sakit');
Route::post('/sakit', [PresensiSakitController::class, 'store'])->name('presensi.sakit.store');
