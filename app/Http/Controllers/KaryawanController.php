<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan  = Karyawan::paginate(8);
        return view('karyawan.index', [
            'title' => 'Karyawan',
            'active' => 'karyawan',
            'karyawans' => $karyawan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create', [
            'title' => 'Tambah Karyawan',
            'active' => 'karyawan',
            'jabatans' => Jabatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric',
            'nama' => 'required|max:255|string',
            'email' => 'required|email',
            'jabatan_id' => 'required',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->nik),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Karyawan::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'jabatan_id' => $request->jabatan_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Alert::success('Berhasil', 'Data Karyawan berhasil ditambahkan');
        return redirect()->Route('karyawan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::where('nik', $id)->first();
        $user = User::where('nik', $id)->first();
        $jabatans = Jabatan::all();
        return view('karyawan.edit', compact('jabatans', 'karyawan', 'user'), [
            'title' => 'Edit Karyawan',
            'active' => 'karyawan',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'jabatan_id' => 'required',
        ]);
        $datakaryawan = [
            'nama' => $request->nama,
            'email' => $request->email,
            'jabatan_id' => $request->jabatan_id,
            'updated_at' => now(),
        ];
        Karyawan::where('nik', $id)->update($datakaryawan);

        $datauser = [
            'nama' => $request->nama,
            'email' => $request->email,
            'updated_at' => now(),
        ];
        User::where('nik', $id)->update($datauser);


        Alert::success('Data Karyawan Berhasil Diubah');
        return redirect()->route('karyawan.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        User::where('nik', $nik)->delete();
        Karyawan::where('nik', $nik)->delete();
        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Dihapus');
    }
}
