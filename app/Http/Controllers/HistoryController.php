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
        $presensis = Presensi::where('nip', auth()->user()->nip)->paginate(8);
        $karyawanside = Karyawan::where('nip', auth()->user()->nip)->first();
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
