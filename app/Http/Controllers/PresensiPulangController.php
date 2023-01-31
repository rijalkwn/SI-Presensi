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
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        $time = Carbon::now()->isoFormat('HH:mm:ss');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();
        if ($presensi) {
            if ($presensi->status == 'Hadir') {
                if ($presensi->jam_pulang == null) {
                    return view('presensi.pulang.index', [
                        'title' => 'Presensi Pulang',
                        'active' => 'presensi_pulang',
                        'today' => $today,
                        'time' => $time,
                        'karyawan' => $karyawan,
                    ]);
                } else {
                    return back()->withErrors([
                        'PresensiError' => 'Anda sudah melakukan presensi pulang hari ini!!',
                    ])->onlyInput('PresensiError');
                }
            } elseif ($presensi->status == 'Izin') {
                return back()->withErrors([
                    'PresensiError' => 'Anda sudah melakukan Absen Izin hari ini!!',
                ])->onlyInput('PresensiError');
            } else {
                return back()->withErrors([
                    'PresensiError' => 'Anda sudah melakukan Absen Sakit hari ini!!',
                ])->onlyInput('PresensiError');
            }
        } else {
            return back()->withErrors([
                'PresensiError' => 'Anda belum melakukan presensi masuk hari ini!!',
            ])->onlyInput('PresensiError');
        }
    }

    public function store()
    {
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();
        //presensi pulang
        if ($presensi) {
            if ($presensi->jam_pulang == null) {
                if (Carbon::now()->isoFormat('HH:mm:ss') > '16:00:00') {
                    Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->update([
                        'jam_pulang' => Carbon::now()->isoFormat('HH:mm:ss'),
                    ]);
                } else {
                    Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->update([
                        'jam_pulang' => Carbon::now()->isoFormat('HH:mm:ss'),
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
