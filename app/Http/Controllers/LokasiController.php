<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class LokasiController extends Controller
{
    public function index()
    {
        $title = 'Lokasi';
        $karyawan = Karyawan::where('nik', Auth::user()->nik)->first();
        return view('lokasi.index', compact('title', 'karyawan'));
    }
}
