<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiIzinController extends Controller
{
    public function create()
    {
        $time = Carbon::now()->isoFormat('HH:mm:ss');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();
        if ($presensi) {
            if ($presensi->status == 'Izin') {
                return back()->withErrors([
                    'PresensiError' => 'Anda sudah melakukan absen izin hari ini!!',
                ])->onlyInput('PresensiError');
            } elseif ($presensi->status == 'Sakit') {
                return back()->withErrors([
                    'PresensiError' => 'Anda sudah melakukan absen sakit hari ini!!',
                ])->onlyInput('PresensiError');
            } else {
                return back()->withErrors([
                    'PresensiError' => 'Anda sudah melakukan presensi masuk hari ini!!',
                ])->onlyInput('PresensiError');
            }
        } else {
            return view('presensi.izin.index', [
                'title' => 'Presensi Izin',
                'karyawan' => $karyawanside,
                'today' => $today,
                'time' => $time,
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|mimes:pdf|max:4096',
            ],
            [
                'file.required' => 'File surat izin tidak boleh kosong',
                'file.mimes' => 'File surat izin harus berformat pdf',
                'file.max' => 'File surat izin maksimal 4MB',
            ]
        );

        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->create([
            'nik' => auth()->user()->nik,
            'nama' => auth()->user()->nama,
            'status' => 'Izin',
            'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
            'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
        ]);

        $file = $request->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'files/suratIzin/';
        $file->move($tujuan_upload, $nama_file);
        $update = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->update([
            'surat' => $nama_file,
        ]);
        if ($update) {
            Alert::success('Presensi Izin', 'Presensi izin berhasil');
            return redirect()->route('home');
        } else {
            Alert::error('Presensi Izin', 'Presensi izin gagal terdapat kesalahan saat mengupload file');
            return redirect()->route('presensi.izin.create');
        }
    }
}
