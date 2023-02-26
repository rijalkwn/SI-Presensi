<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Models\RekapPresensi;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiIzinController extends Controller
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
            return view('presensi.izin.index', [
                'title' => 'Presensi Izin',
                'karyawan' => $karyawanside,
                'today' => $today,
                'time' => $time,
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'file' => 'required|mimes:pdf|max:4096',
                ],
                [
                    'file.required' => 'File surat izin tidak boleh kosong',
                    'file.mimes' => 'File surat izin harus berformat pdf',
                    'file.max' => 'File surat izin maksimal 4MB',
                ]
            );

            $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
            Presensi::create([
                'nik' => auth()->user()->nik,
                'nama' => auth()->user()->nama,
                'status' => 'Izin',
                'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
                'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
            ]);

            $file = $request->file('file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'files/suratIzin/';
            $file->move($tujuan_upload, $nama_file);
            Presensi::where('nik', auth()->user()->nik)->whereDate('created_at', Carbon::today())->update([
                'surat' => $nama_file,
            ]);

            //jikaa nik sudah ada di rekap presensi
            if (RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->exists()) {
                RekapPresensi::where('nik', auth()->user()->nik)->where('bulan', Carbon::now()->isoFormat('MM'))->increment('izin');
            } else {
                RekapPresensi::create([
                    'bulan' => Carbon::now()->isoFormat('MM'),
                    'tahun' => Carbon::now()->isoFormat('YYYY'),
                    'nik' => auth()->user()->nik,
                    'nama' => $karyawan->nama,
                    'status_kepegawaian' => $karyawan->kepegawaian->status_kepegawaian,
                    'hadir_tepat_waktu' => 0,
                    'hadir_terlambat' => 0,
                    'tidak_presensi_pulang' => 0,
                    'izin' => 1,
                    'sakit' => 0,
                ]);
            }
            Alert::success('Berhasil', 'Presensi izin berhasil dilakukan');
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Presensi gagal dilakukan');
            return redirect()->back();
        }
    }
}
