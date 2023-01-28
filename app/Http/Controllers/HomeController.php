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
        $karyawanside = Karyawan::where('nip', auth()->user()->nip)->first();
        $countMasuk = Presensi::WhereNotNull('jam_masuk')->count();
        $countPulang = Presensi::WhereNotNull('jam_pulang')->count();
        $countIzin = Presensi::Where('status', 'Izin')->count();
        $countSakit = Presensi::Where('status', 'Sakit')->count();
        $presensis = Presensi::where('nip', auth()->user()->nip)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(5);
        $presensiAll = Presensi::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(5);
        return view('pages.home', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'presensis' => $presensis,
            'countMasuk' => $countMasuk,
            'countPulang' => $countPulang,
            'countIzin' => $countIzin,
            'countSakit' => $countSakit,
            'presensiAll' => $presensiAll,
            'karyawan' => $karyawanside,
        ]);
    }
}
