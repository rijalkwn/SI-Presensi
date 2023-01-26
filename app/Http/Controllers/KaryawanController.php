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
        return view('karyawan.index', [
            'title' => 'Karyawan',
            'active' => 'karyawan',
            'karyawans' => Karyawan::all(),
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
            'nip' => 'required|numeric',
            'nama' => 'required|max:255|string',
            'email' => 'required|email',
            'jabatan_id' => 'required',
        ]);

        User::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->nip),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Karyawan::create([
            'nip' => $request->nip,
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
        $karyawan = Karyawan::where('nip', $id)->first();
        $user = User::where('nip', $id)->first();
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
        Karyawan::where('nip', $id)->update($datakaryawan);

        $datauser = [
            'nama' => $request->nama,
            'email' => $request->email,
            'updated_at' => now(),
        ];
        User::where('nip', $id)->update($datauser);


        Alert::success('Data Karyawan Berhasil Diubah');
        return redirect()->route('karyawan.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($nip)
    {
        User::where('nip', $nip)->delete();
        Karyawan::where('nip', $nip)->delete();
        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Dihapus');
    }
}
