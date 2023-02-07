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
                'max:4096',
            ],
            'nama' => 'required|string',
            'email' => 'required|email',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tmt' => 'required|date',
            'kepegawaian_id' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'tmt.required' => 'TMT harus diisi',
            'kepegawaian_id.required' => 'Kepegawaian harus diisi',
            'file.max' => 'Ukuran file maksimal 4MB',
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
        return redirect()->back();
    }
}
