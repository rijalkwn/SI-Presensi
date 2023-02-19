<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Imports\ImportUser;
use App\Models\Kepegawaian;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Imports\KaryawanImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kepegawaians = Kepegawaian::all();
        $karyawan  = Karyawan::all();
        $countAdmin = User::where('role', 'admin')->count();
        $countUser = User::where('role', 'user')->count();
        return view('karyawan.index', [
            'title' => 'Karyawan',
            'active' => 'karyawan',
            'karyawans' => $karyawan,
            'countAdmin' => $countAdmin,
            'countUser' => $countUser,
            'kepegawaians' => $kepegawaians,
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
        try {


            $request->validate(
                [
                    'nik' => 'required|numeric|unique:users,nik|digits:16',
                    'nama' => 'required|max:255|string',
                    'email' => 'required|unique:users,email|email:dns',
                    'kepegawaian_id' => 'required',
                ],
                [
                    'nik.required' => 'NIK tidak boleh kosong',
                    'nik.numeric' => 'NIK harus berupa angka',
                    'nik.unique' => 'NIK sudah terdaftar',
                    'nik.digits' => 'NIK harus berjumlah 16 digit',
                    'nama.required' => 'Nama tidak boleh kosong',
                    'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                    'nama.string' => 'Nama harus berupa huruf',
                    'email.required' => 'Email tidak boleh kosong',
                    'email.email' => 'Email tidak valid',
                    'email.unique' => 'Email sudah terdaftar',
                    'kepegawaian_id.required' => 'Kepegawaian tidak boleh kosong',
                ]
            );

            DB::table('users')->insert([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->nik),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('karyawans')->insert([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'email' => $request->email,
                'kepegawaian_id' => $request->kepegawaian_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Alert::success('Berhasil', 'Data Karyawan berhasil ditambahkan');
            return redirect()->Route('karyawan.index');
        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Data Karyawan gagal ditambahkan');
            return redirect()->Route('karyawan.index');
        }
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
        return view('karyawan.modal.edit', compact('kepegawaians', 'karyawan', 'user'), [
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
        try {
            $request->validate(
                [
                    'nama' => 'required|max:255|string',
                    'email' => 'required|unique:users,email|email:dns',
                    'kepegawaian_id' => 'required',
                ],
                [
                    'nama.required' => 'Nama tidak boleh kosong',
                    'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                    'nama.string' => 'Nama harus berupa huruf',
                    'email.required' => 'Email tidak boleh kosong',
                    'email.email' => 'Email tidak valid',
                    'email.unique' => 'Email sudah terdaftar',
                    'kepegawaian_id.required' => 'Kepegawaian tidak boleh kosong',
                ]
            );

            $datauser = [
                'nama' => $request->nama,
                'email' => $request->email,
                'updated_at' => now(),
            ];

            User::where('nik', $id)->update($datauser);

            $datakaryawan = [
                'nama' => $request->nama,
                'email' => $request->email,
                'kepegawaian_id' => $request->kepegawaian_id,
                'updated_at' => now(),
            ];

            Karyawan::where('nik', $id)->update($datakaryawan);

            Alert::success('Berhasil', 'Data Karyawan berhasil diubah');
            return redirect()->Route('karyawan.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Data Karyawan gagal diubah');
            return redirect()->Route('karyawan.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        try {
            User::where('nik', $nik)->delete();
            Karyawan::where('nik', $nik)->delete();
            Alert::success('Data Karyawan Berhasil Dihapus');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Data Karyawan gagal dihapus');
            return redirect()->Route('karyawan.index');
        }
    }

    public function delete($id)
    {
        $karyawan = Karyawan::where('nik', $id)->first();
        return view('karyawan.modal.delete', compact('karyawan'));
    }

    public function bulk(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berformat xlsx, xls, atau csv',
        ]);

        try {
            Excel::import(new KaryawanImport, $request->file('file'));
        } catch (\Exception $e) {
            Alert::error('Error!', 'Data karyawan gagal ditambahkan, pastikan data yang diupload sudah benar sesuai panduan');
            return redirect()->back();
        }

        Alert::success('Success!', 'Data karyawan berhasil ditambahkan');
        return redirect()->back();
    }
}
