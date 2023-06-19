<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Termwind\Components\Dd;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $title = 'Setting';
        return view('setting.edit', compact('setting', 'title'));
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'jam_masuk' => 'required',
            'jam_pulang_senin_kamis' => 'required|after:jam_masuk',
            'jam_pulang_jumat' => 'required|after:jam_masuk',
            'lat' => 'required',
            'lng' => 'required',
            //radius harus angka dan lebih dari 0
            'radius' => 'required|numeric|min:1',
        ], [
            'jam_masuk.required' => 'Jam Masuk tidak boleh kosong',
            'jam_pulang_senin_kamis.required' => 'Jam Pulang tidak boleh kosong',
            'jam_pulang_senin_kamis.after' => 'Jam Pulang tidak boleh kurang dari Jam Masuk',
            'jam_pulang_jumat.required' => 'Jam Pulang tidak boleh kosong',
            'jam_pulang_senin_jumat.after' => 'Jam Pulang tidak boleh kurang dari Jam Masuk',
            'lat.required' => 'Latitude tidak boleh kosong',
            'lng.required' => 'Longitude tidak boleh kosong',
            'radius.required' => 'Radius tidak boleh kosong',
            'radius.numeric' => 'Radius harus angka',
            'radius.min' => 'Radius minimal 1',
        ]);
        $setting = Setting::first();
        $setting->update($validate);

        Alert::success('Berhasil', 'Setting Presensi berhasil diubah');
        return redirect()->back();
    }
}
