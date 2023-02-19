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
use Stevebauman\Location\Facades\Location;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationRuleParser;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\In;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\Rules\Required;
use Illuminate\Validation\Rules\Confirmed;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Dimensions;
use Illuminate\Validation\Rules\Base64Image;


class PresensiMasukController extends Controller
{
    public function create()
    {
        $setting = Setting::where('id', 1)->first();
        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        return view('presensi.masuk.index', [
            'title' => 'Presensi Masuk',
            'karyawan' => $karyawanside,
            'setting' => $setting,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'img' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);
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
        //jika sudah presensi
        if ($presensi == null) {
            if (Carbon::now() > $setting->jam_masuk) {
                // jika terlambat satu jam tidak bisa presensi
                /*if (Carbon::now()->diffInSeconds(Carbon::parse($setting->jam_masuk)) > 3600) {
                    Alert::error('Presensi Masuk', 'Anda sudah lebih dari satu jam terlambat, tidak bisa melakukan presensi masuk');
                    return redirect()->back();
                }
                */
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
                    'keterangan' => 'Terlambat',
                ]);
                //jikaa nik sudah ada di rekap presensi
                if (RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->exists()) {
                    RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->increment('hadir_terlambat');
                } else {
                    RekapPresensi::create([
                        'bulan' => Carbon::now()->isoFormat('MM'),
                        'tahun' => Carbon::now()->isoFormat('YYYY'),
                        'nik' => auth()->user()->nik,
                        'nama' => auth()->user()->nama,
                        'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                        'hadir_tepat_waktu' => 0,
                        'hadir_terlambat' => 1,
                        'izin' => 0,
                        'sakit' => 0,
                    ]);
                }
            } else {
                Presensi::create([
                    'nik' => auth()->user()->nik,
                    'nama' => auth()->user()->nama,
                    'tanggal' => Carbon::now()->isoFormat('DD-MM-YY'),
                    'jam_masuk' => Carbon::now()->isoFormat('HH:mm:ss'),
                    'foto_masuk' => $filename,
                    'lat_masuk' => $request->lat,
                    'lng_masuk' => $request->lng,
                    'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                    'status' => 'Hadir',
                    'keterangan' => 'Tepat Waktu',
                ]);
                //jikaa nik sudah ada di rekap presensi
                if (RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->exists()) {
                    RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->increment('hadir_tepat_waktu');
                } else {
                    RekapPresensi::create([
                        'bulan' => Carbon::now()->isoFormat('MM'),
                        'tahun' => Carbon::now()->isoFormat('YYYY'),
                        'nik' => auth()->user()->nik,
                        'nama' => auth()->user()->nama,
                        'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                        'hadir_tepat_waktu' => 1,
                        'hadir_terlambat' => 0,
                        'izin' => 0,
                        'sakit' => 0,
                    ]);
                }
            }
            Alert::success('Presensi Masuk', 'Presensi masuk berhasil dilakukan');
            return redirect()->route('dashboard');
        } else {
            if ($presensi->status == 'Izin') {
                Alert::error('Presensi Masuk', 'Anda sudah melakukan absensi izin hari ini');
                return redirect()->back();
            } elseif ($presensi->status == 'Sakit') {
                Alert::error('Presensi Masuk', 'Anda sudah melakukan absensi sakit hari ini');
                return redirect()->back();
            } else {
                Alert::error('Presensi Masuk', 'Anda sudah melakukan presensi masuk hari ini');
                return redirect()->back();
            }
        }
    }
}
