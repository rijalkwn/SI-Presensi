<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jabatan.index', [
            'title' => 'Jabatan',
            'active' => 'jabatan',
            'jabatans' => Jabatan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create', [
            'title' => 'Tambah Jabatan',
            'active' => 'jabatan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJabatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'nama_jabatan' => 'required|unique:jabatans|max:255',
            ],
            [
                'nama_jabatan.required' => 'Nama jabatan harus diisi',
                'nama_jabatan.unique' => 'Nama jabatan sudah ada',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter',
            ]
        );
        Jabatan::create($data);
        Alert::success('Success', 'Jabatan berhasil ditambahkan');
        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', [
            'title' => 'Edit Jabatan',
            'active' => 'jabatan',
            'jabatan' => $jabatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJabatanRequest  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $data = $request->validate(
            [
                'nama_jabatan' => 'required|unique:jabatans|max:255',
            ],
            [
                'nama_jabatan.required' => 'Nama jabatan harus diisi',
                'nama_jabatan.unique' => 'Nama jabatan sudah ada',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter',
            ]
        );
        Jabatan::where('id', $jabatan->id)->update($data);
        Alert::success('Success', 'Jabatan berhasil diubah');
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        Jabatan::destroy($jabatan->id);
        Alert::success('Success', 'Jabatan berhasil dihapus');
        return redirect()->route('jabatan.index');
    }
}
