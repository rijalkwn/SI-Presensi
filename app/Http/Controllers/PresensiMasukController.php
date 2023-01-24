<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiMasukController extends Controller
{
    public function create()
    {
        return view('presensi.masuk.index', [
            'title' => 'Presensi Masuk',
            'active' => 'presensi_masuk',
        ]);
    }

    public function store()
    {
    }
}
