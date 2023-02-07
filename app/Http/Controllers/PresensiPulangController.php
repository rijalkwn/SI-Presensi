<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiPulangController extends Controller
{
    public function store()
    {
        $setting = Setting::where('id', 1)->first();
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();
        //presensi pulang
        if ($presensi) {
            if ($presensi->status == 'Hadir') {
                if ($presensi->jam_pulang == null) {
                    if (Carbon::now() > $setting->jam_pulang) {
                        Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->update([
                            'jam_pulang' => Carbon::now()->isoFormat('HH:mm:ss'),
                        ]);
                        Alert::success('Presensi Pulang', 'Presensi pulang berhasil');
                        return redirect()->back();
                    } else {
                        Alert::error('Presensi Pulang', 'Anda belum bisa melakukan presensi pulang');
                        return redirect()->back();
                    }
                } else {
                    Alert::error('Presensi Pulang', 'Anda sudah melakukan presensi pulang');
                    return redirect()->back();
                }
            } elseif ($presensi->status == 'Izin') {
                Alert::error('Presensi Pulang', 'Anda sudah melakukan absensi izin hari ini');
                return redirect()->back();
            } elseif ($presensi->status == 'Sakit') {
                Alert::error('Presensi Pulang', 'Anda sudah melakukan absensi sakit hari ini');
                return redirect()->back();
            }
        } else {
            Alert::error('Presensi Pulang', 'Anda belum melakukan presensi masuk');
            return redirect()->back();
        }
    }
}
