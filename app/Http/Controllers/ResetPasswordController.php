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
        try {
            $validatedData = $request->validate(
                [
                    'email' => 'required|email',
                ],
                [
                    'email.required' => 'Email tidak boleh kosong',
                    'email.email' => 'Email tidak valid',
                ]
            );

            $user = User::where('email', $validatedData['email'])->first();
            //jika email tidak pada database
            if (!$user) {
                Alert::error('Gagal', 'Email tidak terdaftar');
                return redirect()->back();
            }

            DB::table('users')->where('email', $validatedData['email'])->update([
                'password' => Hash::make($user->nik),
            ]);
            Alert::success('Berhasil', 'Password karyawan berhasil direset');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Password karyawan gagal direset');
            return redirect()->back();
        }
    }
}
