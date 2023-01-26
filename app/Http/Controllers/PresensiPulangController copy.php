<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiPulangController extends Controller
{
    public function create()
    {
        return view('presensi.sakit.index', [
            'title' => 'Presensi Sakit',
            'active' => 'presensi_sakit',
        ]);
    }

    public function store()
    {
    }
}
