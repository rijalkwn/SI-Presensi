<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiSakitController extends Controller
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
            return view('presensi.sakit.index', [
                'title' => 'Presensi Sakit',
                'karyawan' => $karyawanside,
                'today' => $today,
                'time' => $time,
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->create([
            'nik' => auth()->user()->nik,
            'nama' => auth()->user()->nama,
            'status' => 'Sakit',
            'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
            'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
        ]);

        $file = $request->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'files/suratSakit/';
        $file->move($tujuan_upload, $nama_file);
        Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->update([
            'surat' => $nama_file,
        ]);
        Alert::success('Absen Sakit', 'Absen sakit berhasil dilakukan');
        return redirect()->back();
    }
}
