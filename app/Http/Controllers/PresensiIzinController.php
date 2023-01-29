<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiIzinController extends Controller
{
    public function create()
    {
        $time = Carbon::now()->isoFormat('HH:mm:ss');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $karyawanside = Karyawan::where('nip', auth()->user()->nip)->first();
        return view('presensi.izin.index', [
            'title' => 'Presensi Izin',
            'active' => 'presensi_izin',
            'karyawan' => $karyawanside,
            'today' => $today,
            'time' => $time,
        ]);
    }

    public function store(Request $request)
    {
        $today = Carbon::today();
        $presensi = Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', $today)->first();
        if ($presensi) {
            if ($presensi->status == 'Izin') {
                Alert::error('Presensi Izin', 'Anda sudah melakukan presensi izin hari ini');
                return redirect()->route('home');
            } elseif ($presensi->status == 'Hadir') {
                Alert::error('Presensi Izin', 'Anda sudah melakukan presensi masuk hari ini');
                return redirect()->route('home');
            } elseif ($presensi->status == 'Sakit') {
                Alert::error('Presensi Izin', 'Anda sudah melakukan presensi sakit hari ini');
                return redirect()->route('home');
            }
        } else {
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);
            $karyawan = Karyawan::where('nip', auth()->user()->nip)->first();
            Presensi::where('nip', auth()->user()->nip)->whereDate('created_at', Carbon::today())->create([
                'nip' => auth()->user()->nip,
                'nama' => auth()->user()->nama,
                'status' => 'Izin',
                'tanggal' => Carbon::now()->isoFormat('YY-MM-DD'),
                'jabatan' => $karyawan->jabatan->nama_jabatan,
                'keterangan' => 'Izin',
                'surat' => $request->file,
            ]);
            Alert::success('Presensi Izin', 'Presensi izin berhasil dilakukan');
            return redirect()->route('home');
        }
    }
}
