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

class ProfileUserController extends Controller
{
    public function index()
    {
        $kepegawaian = Kepegawaian::all();
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        return view('profile.user', [
            'title' => 'Profile',
            'active' => 'profile',
            'karyawan' => $karyawan,
            'kepegawaians' => $kepegawaian
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => [
                Rule::requiredIf(function () {
                    return Karyawan::where('nik', Auth::user()->nik)->first()->foto == null;
                }),
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
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'tmt.required' => 'TMT harus diisi',
            'kepegawaian_id.required' => 'Kepegawaian harus diisi',
        ]);
        $temp = temp_file::where('path', $request->foto)->first();

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
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        if ($temp && $request->foto != null) {
            if (Karyawan::where('nik', $id)->first()->foto != null) {
                unlink(Karyawan::where('nik', $id)->first()->foto);
            }
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->path), public_path('files/profile/' . $id . '_' . $uniq . '.jpg'));
            Karyawan::where('nik', $id)->update([
                'foto' => 'files/profile/' . $id . '_' . $uniq . '.jpg',
            ]);
            $temp->delete();
        }

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }
}
