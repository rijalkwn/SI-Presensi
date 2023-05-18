<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapPresensi;
use App\Models\Presensi;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Karyawan;
use Carbon\Carbon;

class RekapPresensiController extends Controller
{
    public function index()
    {
        $rekaps = RekapPresensi::all();
        $title = 'Rekap Presensi';
        return view('rekap.index', compact('rekaps', 'title'));
    }
    public function user()
    {
        $rekaps = RekapPresensi::where('nik', auth()->user()->nik)->get();
        $title = 'Rekap Presensi';
        $karyawan = Karyawan::where('nik', auth()->user()->nik)->first();
        return view('rekap.user', compact('rekaps', 'title', 'karyawan'));
    }

    public function export(Request $request)
    {
        //request bulan dan tahun
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        //tanggal dan waktu
        $date = Carbon::now()->format('d-m-Y H:i:s');


        $namaFile = 'presensi ' . $namaBulan[$bulan - 1] . ' ' . $tahun . '.xlsx';

        $data = RekapPresensi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
        return Excel::download(new PresensiExport($data, $date, $namaBulan[$bulan - 1]), $namaFile);
    }
}