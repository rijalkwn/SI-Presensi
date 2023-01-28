<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiPulangController extends Controller
{
    public function create()
    {
        $karyawan = Karyawan::where('nip', auth()->user()->nip)->first();
        $time = Carbon::now()->isoFormat('HH:mm:ss');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        if (Presensi::whereDate('created_at', Carbon::today())->first() == null) {
            Alert::error('Presensi Pulang', 'Anda belum melakukan presensi masuk hari ini! Silakan melakukan presensi masuk terlebih dahulu');
            return redirect()->route('presensi.masuk');
        } else {
            return view('presensi.pulang.index', [
                'title' => 'Presensi Pulang',
                'active' => 'presensi_pulang',
                'today' => $today,
                'time' => $time,
                'karyawan' => $karyawan,
                'warning' => $warning ?? null,
            ]);
        }
    }

    public function store()
    {
        $karyawan = Karyawan::where('nip', auth()->user()->nip)->first();
        $presensi = Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', Carbon::today())->first();
        //presensi pulang
        if ($presensi) {
            if ($presensi->jam_pulang == null) {
                if (Carbon::now()->isoFormat('HH:mm:ss') > '16:00:00') {
                    Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', Carbon::today())->update([
                        'jam_pulang' => Carbon::now()->isoFormat('HH:mm:ss'),
                        'keterangan' => 'Tepat waktu',
                    ]);
                } else {
                    Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', Carbon::today())->update([
                        'jam_pulang' => Carbon::now()->isoFormat('HH:mm:ss'),
                        'keterangan' => 'Pulang cepat',
                    ]);
                }
                Alert::success('Presensi Pulang', 'Presensi pulang berhasil dilakukan');
                return redirect()->route('home');
            } else {
                Alert::error('Presensi Pulang', 'Anda sudah melakukan presensi pulang hari ini');
                return redirect()->route('home');
            }
        } else {
            Alert::error('Presensi Pulang', 'Anda belum melakukan presensi masuk hari ini! Silakan melakukan presensi masuk terlebih dahulu');
            return redirect()->route('presensi.masuk');
        }
    }
}
