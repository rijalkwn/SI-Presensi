<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileAdminController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('profile.admin', [
            'title' => 'Profile',
            'active' => 'profile',
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nik' => 'required|max:255',
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
        ]);

        User::where('id', $id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
        ]);
        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }
}
