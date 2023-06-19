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
use Illuminate\Support\Facades\Hash;
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
        request()->validate(
            [
                //nama tidak boleh angka
                'nama' => 'required|max:255|string',
                'email' => 'required|email:unique',
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
        User::where('nik', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'updated_at' => now(),
        ]);

        Karyawan::where('nik', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'kepegawaian_id' => $request->kepegawaian_id,
            'updated_at' => now(),
        ]);

        Alert::success('Berhasil', 'Data Karyawan berhasil diubah');
        return redirect()->Route('karyawan.index');
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
        try {
            // Validasi file yang diunggah
            $request->validate([
                'file' => 'required|mimes:xlsx,xls'
            ]);

            // Proses impor data Excel
            $path = $request->file('file')->getRealPath();
            $data = Excel::toArray([], $request->file('file'));

            if ($data && count($data) > 0) {
                $headerRow = $data[0][0];
                if ($headerRow[0] === 'nik' && $headerRow[1] === 'nama' && $headerRow[2] === 'email' && $headerRow[3] === 'status_kepegawaian') {
                    // Proses pembuatan karyawan
                    foreach ($data[0] as $row) {
                        // Validasi NIK yang unik
                        $user = User::where('nik', $row[0])->first();
                        if ($user) {
                            Alert::error('Gagal', 'NIK "' . $row[0] . '" sudah terdaftar.');
                            return redirect()->route('karyawan.index');
                        }

                        // Validasi email yang unik
                        $user = User::where('email', $row[2])->first();
                        if ($user) {
                            Alert::error('Gagal', 'Email "' . $row[2] . '" sudah terdaftar.');
                            return redirect()->route('karyawan.index');
                        }

                        // Cari data kepegawaian berdasarkan status kepegawaian
                        $kepegawaian = Kepegawaian::where('status_kepegawaian', $row[3])->first();
                        if (!$kepegawaian) {
                            Alert::error('Gagal', 'Data kepegawaian tidak ditemukan untuk status kepegawaian "' . $row[3] . '".');
                            return redirect()->route('karyawan.index');
                        }

                        // Buat user baru
                        $newUser = User::create([
                            'nik' => $row[0],
                            'nama' => $row[1],
                            'email' => $row[2],
                            'password' => Hash::make($row[0]),
                            'role' => 'user',
                        ]);

                        // Buat data karyawan baru
                        // Karyawan::create([
                        //     'nik' => $row[0],
                        //     'nama' => $row[1],
                        //     'email' => $row[2],
                        //     'kepegawaian_id' => $kepegawaian->id,
                        //     'user_id' => $newUser->id,
                        // ]);
                    }

                    // Tampilkan pesan sukses
                    return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diimpor.');
                } else {
                    return redirect()->back()->withErrors('Header kolom file Excel tidak sesuai dengan format yang diharapkan.');
                }
            } else {
                return redirect()->back()->withErrors('Tidak ada data yang ditemukan dalam file Excel.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Terjadi kesalahan saat mengimpor data karyawan.');
        }
    }
}
