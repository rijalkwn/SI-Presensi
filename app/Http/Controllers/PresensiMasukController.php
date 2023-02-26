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


class PresensiMasukController extends Controller
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
                return back()->withErrors([
                    'PresensiError' => 'Anda sudah melakukan presensi masuk hari ini!!',
                ])->onlyInput('PresensiError');
            }
        } else {
            return view('presensi.masuk.index', [
                'title' => 'Presensi Masuk',
                'karyawan' => $karyawanside,
                'setting' => $setting,
            ]);
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
        $path = public_path('img/presensi/masuk/' . $filename);
        file_put_contents($path, $imageData);

        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();

        // data koordinat sekolah
        $setting = Setting::where('id', 1)->first();
        $presensi = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->first();
        //jarak
        if ($jarak > $setting->radius) {
            Alert::error('Gagal', 'Anda tidak berada di dalam radius sekolah!! Pastikan posisi anda berada di dalam lingkaran merah untuk melakukan presensi masuk!!');
            return redirect()->back();
        }
        Presensi::create([
            'nik' => auth()->user()->nik,
            'nama' => auth()->user()->nama,
            'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
            'jam_masuk' => Carbon::now()->isoFormat('HH:mm:ss'),
            'foto_masuk' => $filename,
            'lat_masuk' => $request->lat,
            'lng_masuk' => $request->lng,
            'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
            'status' => 'Hadir',
            //keterangan tepat waktu jika jam masuk kurang dari jam masuk di setting
            'keterangan' => Carbon::now()->isoFormat('HH:mm:ss') > $setting->jam_masuk ? 'Terlambat' : 'Tepat Waktu',
        ]);
        //jika nik sudah ada di rekap presensi
        if (RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->exists()) {
            RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->increment('tidak_presensi_pulang');
        } else {
            RekapPresensi::create([
                'bulan' => Carbon::now()->isoFormat('MM'),
                'tahun' => Carbon::now()->isoFormat('YYYY'),
                'nik' => auth()->user()->nik,
                'nama' => auth()->user()->nama,
                'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                'hadir_terlambat' => 0,
                'hadir_tepat_waktu' => 0,
                'tidak_presensi_pulang' => 1,
                'izin' => 0,
                'sakit' => 0,
            ]);
        }
        Alert::success('Berhasil', 'Presensi masuk berhasil!!');
        return redirect()->route('dashboard');
    }
}
