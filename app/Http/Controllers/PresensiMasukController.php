<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiMasukController extends Controller
{
    public function create()
    {
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        $time = Carbon::now()->isoFormat('HH:mm:ss');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        return view('presensi.masuk.index', [
            'title' => 'Presensi Masuk',
            'active' => 'presensi_masuk',
            'today' => $today,
            'time' => $time,
            'karyawan' => $karyawan,
        ]);
    }

    public function store()
    {
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();
        if ($presensi) {
            Alert::error('Presensi Masuk', 'Anda sudah melakukan presensi masuk hari ini');
            return redirect()->route('home');
        } else {
            //terlambat
            if (Carbon::now()->isoFormat('HH:mm:ss') < '07:01:00') {
                Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->create([
                    'nik' => auth()->user()->nik,
                    'nama' => auth()->user()->nama,
                    'status' => 'Hadir',
                    'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
                    'jam_masuk' => Carbon::now()->isoFormat('HH:mm:ss'),
                    'jabatan' => $karyawan->jabatan->nama_jabatan,
                    'keterangan' => 'Tepat waktu',
                ]);
            } else {
                Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->create([
                    'nik' => auth()->user()->nik,
                    'nama' => auth()->user()->nama,
                    'status' => 'Hadir',
                    'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
                    'jam_masuk' => Carbon::now()->isoFormat('HH:mm:ss'),
                    'jabatan' => $karyawan->jabatan->nama_jabatan,
                    'keterangan' => 'Terlambat',
                ]);
            }

            Alert::success('Presensi Masuk', 'Presensi masuk berhasil dilakukan');
            return redirect()->route('home');
        }
    }
}
