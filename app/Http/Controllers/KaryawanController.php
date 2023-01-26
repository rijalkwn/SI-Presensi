<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\User;

use Illuminate\Http\Request;

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
            'jabatan' => 'required',
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
            'jabatan' => $request->jabatan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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
    public function edit(Karyawan $karyawan, $nip)
    {
        $karyawan = Karyawan::where('nip', $nip)->first();
        $user = User::where('nip', $nip)->first();
        $jabatans = Jabatan::all();
        return view('karyawan.edit', compact('karyawan', 'user', 'jabatans'), [
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
    public function update(Request $request, $nip)
    {
        $request->validate([
            'nip' => 'required|unique:karyawans|min:4|max:255|numeric',
            'nama' => 'required|max:255',
            'email' => 'required|email',
            'jabatan_id' => 'required',
        ]);

        $dataUser = $request->only(['email', 'nama', 'nip']);
        User::where('nip', $nip)->update($dataUser);

        $data = $request->only(['nip', 'nama', 'email', 'jabatan_id']);
        Karyawan::where('nip', $nip)->update($data);


        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Diubah');
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
