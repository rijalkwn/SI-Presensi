<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;

class HistoryUserController extends Controller
{
    public function index()
    {
        $presensis = Presensi::where('nik', auth()->user()->nik)->get();
        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        return view('history.historyUser', [
            'title' => 'History',
            'active' => 'history',
            'presensis' => $presensis,
            'karyawan' => $karyawanside,
        ]);
    }
}
