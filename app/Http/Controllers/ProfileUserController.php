<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\temp_file;
use RealRashid\SweetAlert\Facades\Alert;
use Termwind\Components\Dd;

class ProfileUserController extends Controller
{
    public function index()
    {
        $kepegawaian = Kepegawaian::all();
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        return view('profile.user', [
            'title' => 'My Profile',
            'active' => 'profile',
            'karyawan' => $karyawan,
            'kepegawaians' => $kepegawaian
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' =>
            [
                // required if fileProfile null
                Rule::requiredIf(function () {
                    return Karyawan::where('nik', Auth::user()->nik)->first()->foto == null;
                }),
                //png jpg jpeg
                'mimes:png,jpg,jpeg|max:4096',
            ],
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'tempat_lahir' => 'required|max:255',
            //tanggal lahir harus sebelum hari ini
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'alamat' => 'required|max:255',
            'tmt' => 'required|date|before_or_equal:today',
            'kepegawaian_id' => 'required|numeric',
        ], [
            'file.required' => 'Foto harus diisi',
            'file.max' => 'Foto maksimal 4MB',
            'file.mimes' => 'Foto harus berupa png, jpg, jpeg',
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir harus sebelum hari ini',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'tmt.required' => 'TMT harus diisi',
            'tmt.date' => 'TMT harus berupa tanggal',
            'tmt.before_or_equal' => 'TMT harus sebelum tanggal hari ini',
            'kepegawaian_id.required' => 'Status kepegawaian harus diisi',
            'kepegawaian_id.numeric' => 'Status kepegawaian harus berupa angka',
        ]);
        Karyawan::where('nik', auth()->user()->nik)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'tmt' => $request->tmt,
            'kepegawaian_id' => $request->kepegawaian_id,
        ]);

        User::where('nik', auth()->user()->nik)->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);


        $file = $request->file('file');
        if ($file) {
            $profil = Karyawan::where('nik', auth()->user()->nik)->first();
            if ($profil->foto != null) {
                unlink($profil->foto);
            }
            $file->move('files/profile', $file->getClientOriginalName());
            Karyawan::where('nik', auth()->user()->nik)->update([
                'foto' => 'files/profile/' . $file->getClientOriginalName()
            ]);
        }
        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back()->withErrors($request->all());
    }
}