<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Inisialisasi array untuk menyimpan data dalam format yang dapat digunakan oleh Highcharts
        $data = Presensi::whereDate('created_at', Carbon::today())->select(DB::raw('count(*) as count, status'))->groupBy('status')->get();
        // $data = Presensi::where('')select(DB::raw('count(*) as count, status'))
        //     ->groupBy('status')
        //     ->get();

        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        $countMasuk = Presensi::whereDate('created_at', Carbon::today())->WhereNotNull('jam_masuk')->count();
        $countIzin = Presensi::whereDate('created_at', Carbon::today())->Where('status', 'Izin')->count();
        $countSakit = Presensi::whereDate('created_at', Carbon::today())->Where('status', 'Sakit')->count();
        $presensiAll = Presensi::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get();
        //presensiChart pada bulan ini user ini
        $presensis = Presensi::whereMonth('created_at', Carbon::now()->month)->where('nik', auth()->user()->nik)->orderBy('created_at', 'desc')->get();
        return view('pages.home', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'presensis' => $presensis,
            'countMasuk' => $countMasuk,
            'countIzin' => $countIzin,
            'countSakit' => $countSakit,
            'presensiAll' => $presensiAll,
            'karyawan' => $karyawanside,
            'data' => $data,
        ]);
    }

    public function chart()
    {
        // Ambil data presensiChart
        $presensisChart = Presensi::all();

        // Inisialisasi array untuk menyimpan jumlah kehadiran, izin, dan sakit setiap bulannya
        $kehadiran = [];
        $izin = [];
        $sakit = [];

        // Proses data presensi untuk menghitung jumlah kehadiran, izin, dan sakit setiap bulannya
        foreach ($presensisChart as $presensiChart) {
            $tanggal = date('Y-m', strtotime($presensiChart->tanggal));
            switch ($presensiChart->status) {
                case 'hadir':
                    if (!isset($kehadiran[$tanggal])) {
                        $kehadiran[$tanggal] = 0;
                    }
                    $kehadiran[$tanggal]++;
                    break;
                case 'izin':
                    if (!isset($izin[$tanggal])) {
                        $izin[$tanggal] = 0;
                    }
                    $izin[$tanggal]++;
                    break;
                case 'sakit':
                    if (!isset($sakit[$tanggal])) {
                        $sakit[$tanggal] = 0;
                    }
                    $sakit[$tanggal]++;
                    break;
            }
        }

        // Inisialisasi array untuk menyimpan data dalam format yang dapat digunakan oleh Highcharts
        $data = [];

        // Looping untuk memproses data kehadiran, izin, dan sakit setiap bulannya
        foreach ($kehadiran as $bulan => $jumlah_kehadiran) {
            $jumlah_izin = isset($izin[$bulan]) ? $izin[$bulan] : 0;
            $jumlah_sakit = isset($sakit[$bulan]) ? $sakit[$bulan] : 0;
            $data[] = [
                'bulan' => $bulan,
                'kehadiran' => $jumlah_kehadiran,
                'izin' => $jumlah_izin,
                'sakit' => $jumlah_sakit,
            ];
        }

        // Kirim data ke view untuk ditampilkan pada chart
        return view('pages.dashboardAdmin', compact('data'));
    }
}
