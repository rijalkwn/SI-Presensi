<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KepegawaianController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\PresensiIzinController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\PresensiMasukController;
use App\Http\Controllers\PresensiSakitController;
use App\Http\Controllers\ChangePasswordController;
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

Route::group(['middleware' => ['prevent-back-history']], function () {
    //center
    Route::get('/', [CenterController::class, 'index'])->name('home');

    //login 
    Route::get('/login', [LoginController::class, 'show'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform')->middleware('guest');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout.perform')->middleware('auth');
});



//history
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/user/history', [HistoryController::class, 'index'])->name('history.user');
});
Route::group(['middleware' => 'admin'], function () {
    //history
    Route::get('/history/cetak', [HistoryController::class, 'cetak'])->name('history.cetak');
    Route::get('admin/history', [HistoryController::class, 'indexadmin'])->name('history.admin');
    Route::delete('/history/delete-all', [HistoryController::class, 'destroy'])->name('history.destroy');
    //karyawan
    Route::get('/karyawan/{{ $karyawan->id }}/edit', [KaryawanController::class, 'edit'])->name('karyawan');
    Route::resource('/karyawan', KaryawanController::class)->names('karyawan');
    Route::post('/karyawan/import', [KaryawanController::class, 'bulk'])->name('karyawan.bulk');
    //kepegawaian
    Route::get('/kepegawaian/{{ $kepegawaian->id }}/edit', [KepegawaianController::class, 'edit']);
    Route::resource('/kepegawaian', KepegawaianController::class)->names('kepegawaian');

    //setting presensi
    Route::get('/setting/create', [SettingController::class, 'create'])->name('setting.create');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
});


Route::group(['middleware' => 'user'], function () {
    //PRESENSI
    //masuk
    Route::get('/dashbaord/presensi-masuk', [PresensiMasukController::class, 'create'])->name('presensi.masuk');
    Route::post('/dashbaord/presensi-masuk', [PresensiMasukController::class, 'store'])->name('presensi.masuk.store');

    //pulang
    Route::get('/dashbaord/presensi-pulang', [PresensiPulangController::class, 'create'])->name('presensi.pulang');
    Route::post('/dashbaord/presensi-pulang', [PresensiPulangController::class, 'store'])->name('presensi.pulang.store');

    //izin
    Route::get('/dashbaord/presensi-izin', [PresensiIzinController::class, 'create'])->name('presensi.izin');
    Route::post('/dashbaord/presensi-izin', [PresensiIzinController::class, 'store'])->name('presensi.izin.store');

    //sakit
    Route::get('/dashbaord/presensi-sakit', [PresensiSakitController::class, 'create'])->name('presensi.sakit');
    Route::post('/dashbaord/presensi-sakit', [PresensiSakitController::class, 'store'])->name('presensi.sakit.store');

    //lokasi
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');
});

//profile admin
Route::resource('/admin/profile', ProfileAdminController::class)->names('profile_admin')->middleware('admin');
//profile user
Route::resource('/user/profile', ProfileUserController::class)->names('profile_user')->middleware('user');

//change password
Route::resource('/admin/change_password', ChangePasswordController::class);
Route::resource('/user/change_password', ChangePasswordController::class);
