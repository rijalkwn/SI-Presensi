<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new PresensiExport, 'presensi.xlsx');
    }
}
