<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Termwind\Components\Dd;

class ChangePasswordController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::where('nik',  Auth::user()->nik)->first();
        $user = User::where('nik',  Auth::user()->nik)->first();
        $admin = User::where('nik',  Auth::user()->nik)->first();
        return view('password.index', [
            'title' => 'Change Password',
        ])->with(compact('user', 'admin', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate
            $request->validate([
                // olf password must same with password in database
                'old_password' => 'required',
                'new_password' => 'required|string',
                'ver_password' => 'required|string|same:new_password',
            ], [
                'old_password.required' => 'Password lama tidak boleh kosong',
                'new_password.required' => 'Password baru tidak boleh kosong',
                'ver_password.required' => 'Verifikasi password tidak boleh kosong',
                'ver_password.same' => 'Verifikasi password tidak sama dengan password baru',
            ]);
            //cek old password
            $user = User::where('nik', $id)->first();
            if (!Hash::check($request->old_password, $user->password)) {
                Alert::error('Gagal', 'Password lama tidak sesuai');
                return redirect()->route('password.index');
            }
            //cek new password
            if (Hash::check($request->new_password, $user->password)) {
                Alert::error('Gagal', 'Password baru tidak boleh sama dengan password lama');
                return redirect()->route('password.index');
            }
            User::where('nik', $id)->update([
                'password' => bcrypt($request->new_password),
            ]);

            Alert::success('Berhasil', 'Password berhasil diubah');
            return redirect()->route('password.index');
        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Password gagal diubah');
            return redirect()->route('password.index');
        }
    }
}
