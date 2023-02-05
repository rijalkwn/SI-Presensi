<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function create()
    {
        $setting = Setting::first();
        $title = 'Setting';
        return view('setting.edit', compact('setting', 'title'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'jam_masuk' => 'required',
            'jam_pulang' => 'required|after:jam_masuk',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
        ], [
            'jam_masuk.required' => 'Jam Masuk tidak boleh kosong',
            'jam_pulang.required' => 'Jam Pulang tidak boleh kosong',
            'jam_pulang.after' => 'Jam Pulang tidak boleh kurang dari Jam Masuk',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'longitude.required' => 'Longitude tidak boleh kosong',
            'radius.required' => 'Radius tidak boleh kosong',
        ]);
        $setting = Setting::first();
        if ($setting) {
            $setting->update($validate);
        } else {
            Setting::create($validate);
        }
        Alert::success('Berhasil', 'Setting berhasil disimpan');
        return redirect()->back();
    }
}
