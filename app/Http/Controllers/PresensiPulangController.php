<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RekapPresensi;
use RealRashid\SweetAlert\Facades\Alert;


class PresensiPulangController extends Controller
{
    public function create()
    {
        $setting = Setting::where('id', 1)->first();
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
                //harus di atas jam pulang
                //cek hari ini hari apa
                $hari = Carbon::now()->isoFormat('dddd');
                //jika hari ini monday hingga thursday
                if ($hari == 'Monday' || $hari == 'Tuesday' || $hari == 'Wednesday' || $hari == 'Thursday') {
                    if (Carbon::now()->isoFormat('HH:mm:ss') < $setting->jam_pulang_senin_kamis) {
                        return back()->withErrors([
                            'PresensiError' => 'Anda belum bisa melakukan presensi pulang!!',
                        ])->onlyInput('PresensiError');
                    } else {
                        return view('presensi.pulang.index', [
                            'title' => 'Presensi Pulang',
                            'karyawan' => $karyawanside,
                            'setting' => $setting,
                            'presensi' => $presensi,
                        ]);
                    }
                } elseif ($hari == 'Friday') {
                    if (Carbon::now()->isoFormat('HH:mm:ss') < $setting->jam_pulang_jumat) {
                        return back()->withErrors([
                            'PresensiError' => 'Anda belum bisa melakukan presensi pulang!!',
                        ])->onlyInput('PresensiError');
                    } else {
                        return view('presensi.pulang.index', [
                            'title' => 'Presensi Pulang',
                            'karyawan' => $karyawanside,
                            'setting' => $setting,
                            'presensi' => $presensi,
                        ]);
                    }
                } else {
                    return back()->withErrors([
                        'PresensiError' => 'Anda tidak bisa melakukan presensi pulang!!',
                    ])->onlyInput('PresensiError');
                }
            }
        } else {
            return back()->withErrors([
                'PresensiError' => 'Anda belum melakukan presensi masuk hari ini!!',
            ])->onlyInput('PresensiError');
        }
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'img' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'jarak' => 'required',
        ]);

        $jarak = $request->jarak;
        // Mendapatkan data URI dari request
        $dataUri = $request->img;

        // Mendapatkan header dan body dari data URI
        [$header, $body] = explode(',', $dataUri);

        // Mendapatkan tipe konten dari header
        $contentType = explode(';', $header)[0];

        // Mendapatkan ekstensi file dari tipe konten
        $extension = explode('/', $contentType)[1];

        // Mendecode base64 dan menyimpan gambar ke file
        $imageData = base64_decode($body);
        $filename = time() . '_' . Str::random(10) . '.' . $extension;
        $path = public_path('img/presensi/pulang/' . $filename);
        file_put_contents($path, $imageData);

        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();

        // data koordinat sekolah
        $setting = Setting::where('id', 1)->first();
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();
        //jarak
        if ($jarak > $setting->radius) {
            Alert::error('Gagal', 'Anda tidak berada di dalam radius sekolah!! Pastikan anda berada di dalam radius sekolah untuk melakukan presensi masuk!!');
            return redirect()->back();
        }
        //presensi update
        $presensi->update([
            'jam_pulang' => Carbon::now()->isoFormat('HH:mm:ss'),
            'foto_pulang' => $filename,
            'lat_pulang' => $request->lat,
            'lng_pulang' => $request->lng,
        ]);

        if (Carbon::now()->isoFormat('HH:mm:ss') > $setting->jam_masuk) {
            RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->increment('hadir_terlambat');
            RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->decrement('tidak_presensi_pulang');
        } else {
            RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->increment('hadir_tepat_waktu');
            RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->decrement('tidak_presensi_pulang');
        }

        Alert::success('Berhasil', 'Presensi pulang berhasil!!');
        return redirect()->route('dashboard');
    }
}
