<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Stevebauman\Location\Facades\Location;

class PresensiMasukController extends Controller
{
    public function create()
    {
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        $time = Carbon::now()->isoFormat('HH:mm:ss');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();

        if ($presensi) {
            if ($presensi->status == 'Hadir') {
                return back()->withErrors([
                    'PresensiError' => 'Anda sudah melakukan presensi masuk hari ini!!',
                ])->onlyInput('PresensiError');
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
            return view('presensi.masuk.index', [
                'title' => 'Presensi Masuk',
                'active' => 'presensi_masuk',
                'today' => $today,
                'time' => $time,
                'karyawan' => $karyawan,
            ]);
        }
    }

    public function store(Request $request)
    {
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();


        // data koordinat sekolah
        $koordinat = Setting::where('id', 1)->first();

        $jarak = $this->distance($request->lat, $request->lng, $koordinat->latitude, $koordinat->longitude, "K"); // <-- dihitung menggunakan satuan kilometer

        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();

        if ($jarak > $koordinat->radius) {
            Alert::error('Presensi Masuk', 'Anda tidak berada di dalam radius sekolah');
            return redirect()->back();
        } else {
            if (Carbon::now()->isoFormat('HH:mm:ss') > $koordinat->jam_masuk) {
                $presensi->create([
                    'nik' => auth()->user()->nik,
                    'nama' => auth()->user()->nama,
                    'status' => 'Terlambat',
                    'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
                    'jam_masuk' => Carbon::now()->isoFormat('HH:mm:ss'),
                    'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                ]);
            } else {
                $presensi->create([
                    'nik' => auth()->user()->nik,
                    'nama' => auth()->user()->nama,
                    'status' => 'Hadir Tepat Waktu',
                    'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
                    'jam_masuk' => Carbon::now()->isoFormat('HH:mm:ss'),
                    'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                ]);
            }
            Alert::success('Presensi Masuk', 'Presensi masuk berhasil dilakukan');
            return redirect()->route('home');
        }
    }
}
