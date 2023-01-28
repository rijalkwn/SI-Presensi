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
        $karyawan = Karyawan::where('nip', auth()->user()->nip)->first();
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
        $karyawan = Karyawan::where('nip', auth()->user()->nip)->first();
        $presensi = Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', Carbon::today())->first();
        if ($presensi) {
            Alert::error('Presensi Masuk', 'Anda sudah melakukan presensi masuk hari ini');
            return redirect()->route('home');
        } else {
            //terlambat
            if (Carbon::now()->isoFormat('HH:mm:ss') < '07:01:00') {
                Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', Carbon::today())->create([
                    'nip' => auth()->user()->nip,
                    'nama' => auth()->user()->nama,
                    'status' => 'Hadir',
                    'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
                    'jam_masuk' => Carbon::now()->isoFormat('HH:mm:ss'),
                    'jabatan' => $karyawan->jabatan->nama_jabatan,
                    'keterangan' => 'Tepat waktu',
                ]);
            } else {
                Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', Carbon::today())->create([
                    'nip' => auth()->user()->nip,
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
