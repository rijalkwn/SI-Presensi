<?php

namespace App\Http\Controllers;

use App;
use PDF;
use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\Presensi;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Models\RekapPresensi;
use App\Exports\PresensiExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Presensi::select(DB::raw('count(*) as count, status'))
            ->groupBy('status')
            ->get();
        $title = 'History';
        //ditampilkan dari yg terakhir di tambahkan
        $presensis = Presensi::orderBy('created_at', 'desc')->get();

        return view('history.historyAdmin', compact('title', 'presensis', 'data'));
    }

    public function delete($id)
    {
        if ($id == 'all') {
            $presensi = Presensi::all();
            return view('history.modal.delete_all', compact('presensi'));
        } else {
            $presensi = Presensi::where('id', $id)->first();
            $rekap = RekapPresensi::where('nik', $presensi->nik)->first();
            return view('history.modal.delete', compact('presensi'));
        }
    }
    public function destroy($id)
    {
        if ($id == 'all') {
            Presensi::truncate();
            RekapPresensi::truncate();
        } else {
            $presensi = Presensi::where('id', $id)->first();
            //nik dari presensi = nik dari rekap
            $rekap = RekapPresensi::where('nik', $presensi->nik)->first();
            if ($presensi->status == 'Hadir' && $presensi->keterangan == 'Tepat Waktu') {
                if ($rekap->hadir_tepat_waktu == 1 && $rekap->hadir_terlambat == 0 && $rekap->izin == 0 && $rekap->sakit == 0) {
                    RekapPresensi::where('nik', $presensi->nik)->delete();
                } else {
                    $rekap->hadir_tepat_waktu = $rekap->hadir_tepat_waktu - 1;
                    $rekap->save();
                }
            } elseif ($presensi->status == 'Hadir' && $presensi->keterangan == 'Terlambat') {
                if ($rekap->hadir_tepat_waktu == 0 && $rekap->hadir_terlambat == 1 && $rekap->izin == 0 && $rekap->sakit == 0) {
                    RekapPresensi::where('nik', $presensi->nik)->delete();
                } else {
                    $rekap->hadir_terlambat = $rekap->hadir_terlambat - 1;
                    $rekap->save();
                }
            } elseif ($presensi->status == 'Izin') {
                if ($rekap->hadir_tepat_waktu == 0 && $rekap->hadir_terlambat == 0 && $rekap->izin == 1 && $rekap->sakit == 0) {
                    RekapPresensi::where('nik', $presensi->nik)->delete();
                } else {
                    $rekap->izin = $rekap->izin - 1;
                    $rekap->save();
                }
            } elseif ($presensi->status == 'Sakit') {
                if ($rekap->hadir_tepat_waktu == 0 && $rekap->hadir_terlambat == 0 && $rekap->izin == 0 && $rekap->sakit == 1) {
                    RekapPresensi::where('nik', $presensi->nik)->delete();
                } else {
                    $rekap->sakit = $rekap->sakit - 1;
                    $rekap->save();
                }
            }
            $presensi->delete();
        }
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->back();
    }



    public function export(Request $request)
    {
        //request bulan dan tahun
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $data = RekapPresensi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
        return Excel::download(new PresensiExport($data), 'presensi.xlsx');
    }
}
