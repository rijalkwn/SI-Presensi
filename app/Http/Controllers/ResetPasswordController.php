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
        return view('resetPassword.index', [
            'title' => 'Reset Password',
            'active' => 'resetPassword',
        ]);
    }
    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nik' => 'required|numeric|digits:16',
                'konfirmasi' => 'required|same:nik',
            ],
            [
                'nik.required' => 'NIK tidak boleh kosong',
                'nik.numeric' => 'NIK harus berupa angka',
                'nik.digits' => 'NIK harus berjumlah 16 digit',
                'konfirmasi.required' => 'Konfirmasi NIK tidak boleh kosong',
                'konfirmasi.same' => 'Konfirmasi NIK tidak sama dengan NIK',
            ]
        );
        //validasi nik harus ada di database
        $user = User::where('nik', $validatedData['nik'])->first();
        if (!$user) {
            Alert::error('Warning', 'Reset password gagal, email atau NIK tidak terdaftar');
            return redirect()->back();
        }

        DB::table('users')->where('nik', $validatedData['nik'])->update([
            'password' => Hash::make($user->nik),
        ]);
        Alert::success('Berhasil', 'Password karyawan berhasil direset');
        return redirect()->back();
    }
}