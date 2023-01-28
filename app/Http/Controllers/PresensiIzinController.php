<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Karyawan;

class PresensiIzinController extends Controller
{
    public function create()
    {
        $karyawanside = Karyawan::where('nip', auth()->user()->nip)->first();
        return view('presensi.izin.index', [
            'title' => 'Presensi Izin',
            'active' => 'presensi_izin',
            'karyawan' => $karyawanside,
        ]);
    }

    public function store()
    {
    }
}
