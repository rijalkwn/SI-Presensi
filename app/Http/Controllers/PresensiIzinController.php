<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiIzinController extends Controller
{
    public function create()
    {
        return view('presensi.izin.index', [
            'title' => 'Presensi Izin',
            'active' => 'presensi_izin',
        ]);
    }

    public function store()
    {
    }
}
