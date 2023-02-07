<?php

namespace App\Http\Controllers;

use App;
use PDF;
use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Exports\PresensiExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Termwind\Components\Dd;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'History';
        $presensis = Presensi::get();

        return view('history.historyAdmin', compact('title', 'presensis'));
    }

    public function destroy($id)
    {
        Presensi::where('id', $id)->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function delete($id)
    {
        $presensi = Presensi::where('id', $id)->first();
        return view('history.modal.delete', compact('presensi'));
    }

    public function export(Request $request)
    {
        //request bulamn
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        //query data
        $data = Presensi::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();
        return Excel::download(new PresensiExport($data), 'presensi.xlsx');
    }
}
