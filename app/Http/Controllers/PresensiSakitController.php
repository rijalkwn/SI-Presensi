<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use App\Models\RekapPresensi;
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
            'file' => 'required|mimes:pdf|max:4096',
        ], [
            'file.required' => 'File surat sakit harus diisi!!',
            'file.mimes' => 'File surat sakit harus berformat PDF!!',
            'file.max' => 'File surat sakit maksimal 4MB!!',
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
        $update = Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->update([
            'surat' => $nama_file,
        ]);

        //jikaa nik sudah ada di rekap presensi
        if (RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->exists()) {
            RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->increment('sakit');
        } else {
            RekapPresensi::create([
                'nik' => auth()->user()->nik,
                'nama' => $karyawan->nama,
                'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                'bulan' => Carbon::now()->isoFormat('MM'),
                'tahun' => Carbon::now()->isoFormat('YYYY'),
                'hadir_tepat_waktu' => 0,
                'hadir_terlambat' => 0,
                'izin' => 0,
                'sakit' => 1,
            ]);
        }

        if ($update) {
            Alert::success('Presensi Sakit', 'Presensi sakit berhasil');
            return redirect()->route('home');
        } else {
            Alert::error('Presensi Sakit', 'Presensi sakit gagal terdapat kesalahan saat mengupload file');
            return redirect()->route('presensi.sakit.create');
        }
    }
}
