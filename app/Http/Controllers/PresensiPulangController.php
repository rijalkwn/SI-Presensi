<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiPulangController extends Controller
{
    public function create()
    {
        return view('presensi.pulang.index', [
            'title' => 'Presensi Pulang',
            'active' => 'presensi_pulang',
        ]);
    }

    public function store()
    {
    }
}
