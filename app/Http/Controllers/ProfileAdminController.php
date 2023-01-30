<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileAdminController extends Controller
{
    public function index()
    {
        return view('profile.admin', [
            'title' => 'Profile',
            'active' => 'profile',
            'user' => User::find(auth()->user()->id)
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|max:255',
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
        ], [
            'nik.required' => 'NIK harus diisi',
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
        ]);

        $user = User::find(auth()->user()->id);
        $user->update($data);
        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('profile.index');
    }
}
