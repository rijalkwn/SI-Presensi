<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Presensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        $countMasuk = Presensi::whereDate('created_at', Carbon::today())->WhereNotNull('jam_masuk')->count();
        $countIzin = Presensi::whereDate('created_at', Carbon::today())->Where('status', 'Izin')->count();
        $countSakit = Presensi::whereDate('created_at', Carbon::today())->Where('status', 'Sakit')->count();
        $presensiAll = Presensi::whereDate('created_at', Carbon::today())->get();
        $presensis = Presensi::where('nik', auth()->user()->nik)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return view('pages.home', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'presensis' => $presensis,
            'countMasuk' => $countMasuk,
            'countIzin' => $countIzin,
            'countSakit' => $countSakit,
            'presensiAll' => $presensiAll,
            'karyawan' => $karyawanside,
        ]);
    }
}
