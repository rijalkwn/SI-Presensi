<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;

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

    public function store()
    {
    }
}
