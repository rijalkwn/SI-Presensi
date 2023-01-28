<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        $presensis = Presensi::where('nip', auth()->user()->nip)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        $presensisAll = Presensi::where('nip', auth()->user()->nip)->get();
        return view('history.index', [
            'title' => 'History',
            'active' => 'history',
            'presensis' => $presensis,
            'presensisAll' => $presensisAll,
        ]);
    }
}
