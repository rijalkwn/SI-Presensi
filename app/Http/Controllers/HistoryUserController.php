<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryUserController extends Controller
{
    public function index()
    {
        $data = Presensi::where('nik', Auth()->user()->nik)->select(DB::raw('count(*) as count, status'))
            ->groupBy('status')
            ->get();
        $presensis = Presensi::where('nik', auth()->user()->nik)->orderBy('created_at', 'desc')->get();
        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        return view('history.historyUser', [
            'title' => 'History',
            'active' => 'history',
            'presensis' => $presensis,
            'karyawan' => $karyawanside,
            'data' => $data
        ]);
    }
}
