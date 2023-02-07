<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
        // Validate
        $request->validate([
            // olf password must same with password in database
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Password lama tidak sama');
                    }
                },
            ],
            'new_password' => 'required|string',
            'ver_password' => 'required|string|same:new_password',
        ], [
            'old_password.required' => 'Password lama tidak boleh kosong',
            'new_password.required' => 'Password baru tidak boleh kosong',
            'ver_password.required' => 'Verifikasi password tidak boleh kosong',
            'ver_password.same' => 'Verifikasi password tidak sama dengan password baru',
        ]);


        User::where('nik', $id)->update([
            'password' => bcrypt($request->new_password),
        ]);

        Alert::success('Berhasil', 'Password berhasil diubah');
        return redirect()->back();
    }
}
