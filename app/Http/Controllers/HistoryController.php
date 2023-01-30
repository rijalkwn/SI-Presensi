<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Karyawan;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        $presensis = Presensi::where('nik', auth()->user()->nik)->paginate(8);
        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        $presensiAll = Presensi::paginate(8);
        return view('history.index', [
            'title' => 'History',
            'active' => 'history',
            'presensis' => $presensis,
            'presensiAll' => $presensiAll,
            'karyawan' => $karyawanside,
        ]);
    }
}
