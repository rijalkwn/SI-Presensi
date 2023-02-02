<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class HistoryController extends Controller
{
    public function index()
    {
        $presensis = Presensi::where('nik', auth()->user()->nik)->paginate(10);
        $karyawanside = Karyawan::where('nik', auth()->user()->nik)->first();
        return view('history.historyUser', [
            'title' => 'History',
            'active' => 'history',
            'presensis' => $presensis,
            'karyawan' => $karyawanside,
        ]);
    }
    public function indexadmin(Request $request)
    {
        $selectedMonth = $request->input('bulan');
        $data = Presensi::when($selectedMonth, function ($query) use ($selectedMonth) {
            return $query->whereMonth('created_at', $selectedMonth);
        })->paginate(10);
        $title = 'History';

        return view('history.historyAdmin', compact('data', 'selectedMonth', 'title'));
    }
    public function cetak(Request $request)
    {
        $selectedMonth = $request->input('bulan');
        $data = Presensi::whereMonth('created_at', $selectedMonth)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('history.cetak', compact('data'));
        return $pdf->stream('data_presensi.pdf');
    }

    public function destroy(Request $request)
    {
        DB::table('presensis')->delete();
        Alert::success('Berhasil', 'Data Presensi Berhasil Dihapus');
        return redirect()->back();
    }
}
