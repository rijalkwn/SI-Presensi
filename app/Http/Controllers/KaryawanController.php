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
            'nip' => 'required|unique:karyawans|min:4|max:255|numeric',
            'nama' => 'required|max:255|string',
            'email' => 'required|email',
            'jabatan' => 'required',
        ], [
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'nama.string' => 'Nama harus berupa string',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ]);

        Karyawan::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
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


        return redirect()->route('datakaryawan.index')->with('success', 'Data Karyawan Berhasil Ditambahkan');
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
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        //
    }
}
