<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Karyawan;


class PresensiMasukController extends Controller
{
    public function create()
    {
        $karyawan = Karyawan::where('nip', auth()->user()->nip)->first();
        $time = Carbon::now()->isoFormat('HH:mm:ss');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        return view('presensi.masuk.index', [
            'title' => 'Presensi Masuk',
            'active' => 'presensi_masuk',
            'today' => $today,
            'time' => $time,
            'karyawan' => $karyawan,
        ]);
    }

    public function store()
    {
    }
}
