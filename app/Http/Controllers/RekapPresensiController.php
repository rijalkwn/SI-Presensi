<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapPresensi;
use App\Models\Presensi;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

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
}
