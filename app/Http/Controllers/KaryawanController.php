<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use Illuminate\Http\Request;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Termwind\Components\Dd;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan  = Karyawan::paginate(10);
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
            'kepegawaians' => Kepegawaian::all(),
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
        $request->validate(
            [
                'nik' => 'required|numeric|unique:users,nik',
                'nama' => 'required|max:255|string',
                'email' => 'required|unique:users,email|email:dns',
                'kepegawaian_id' => 'required',
            ],
            [
                'nik.required' => 'NIK tidak boleh kosong',
                'nik.numeric' => 'NIK harus berupa angka',
                'nik.unique' => 'NIK sudah terdaftar',
                'nama.required' => 'Nama tidak boleh kosong',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                'nama.string' => 'Nama harus berupa huruf',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'kepegawaian_id.required' => 'Kepegawaian tidak boleh kosong',
            ]
        );

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
            'kepegawaian_id' => $request->kepegawaian_id,
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
        $kepegawaians = Kepegawaian::all();
        return view('karyawan.edit', compact('kepegawaians', 'karyawan', 'user'), [
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
            'email' => 'required|email|unique:users,nik',
            'kepegawaian_id' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.string' => 'Nama harus berupa huruf',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'kepegawaian_id.required' => 'Kepegawaian tidak boleh kosong',
        ]);
        $datakaryawan = [
            'nama' => $request->nama,
            'email' => $request->email,
            'kepegawaian_id' => $request->jabatan_id,
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

    public function bulk(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berformat xlsx, xls, atau csv',
        ]);

        Excel::import(new KaryawanImport, $request->file('file'));

        // Alert success
        Alert::success('Success!', 'Data karyawan berhasil ditambahkan');
        return redirect()->back();
    }
}
