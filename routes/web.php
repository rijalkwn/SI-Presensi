<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\PresensiMasukController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ConfirmPasswordController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\EmailVerificationPromptController;


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



//profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update']);

//password
Route::get('/password', [PasswordController::class, 'index'])->name('password');
Route::post('/password', [PasswordController::class, 'update']);

//email verification
Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');

//forgot password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

//reset password
Route::get('/reset-password/', [ResetPasswordController::class, 'show'])->name('reset-password');
Route::post('/reset-password', [ResetPasswordController::class, 'send'])->name('password.update');

//confirm password
Route::get('/confirm-password', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/confirm-password', [ConfirmPasswordController::class, 'confirm']);


Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

//Karyawan
Route::get('/datakaryawan/{{ $karyawan->nip }}/edit', [KaryawanController::class, 'edit']);
Route::resource('/datakaryawan', KaryawanController::class)->names('datakaryawan');

// //jabatan
// Route::get('/jabatan/{{ $jabatan->id }}/edit', [JabatanController::class, 'edit']);
// Route::resource('/jabatan', JabatanController::class)->names('jabatan');

//jabatan
Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan');
Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');


//PRESENSI
//masuk
Route::get('/masuk', [PresensiMasukController::class, 'create'])->name('presensi.masuk');
