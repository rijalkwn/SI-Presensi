<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.reset', [
            'title' => 'Reset Password',
            'active' => 'resetPassword',
        ]);
    }
    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password tidak sama',
                'password_confirmation.required' => 'Verifikasi password tidak boleh kosong',
            ]
        );

        $user = User::where('email', $validatedData['email'])->first();
        //jika email tidak pada database
        if (!$user) {
            Alert::error('Gagal', 'Email tidak terdaftar');
            return redirect()->back();
        }

        DB::table('users')->where('email', $validatedData['email'])->update([
            'password' => Hash::make($validatedData['password']),
        ]);
        Alert::success('Berhasil', 'Password karyawan berhasil direset');
        return redirect()->back();
    }
}
