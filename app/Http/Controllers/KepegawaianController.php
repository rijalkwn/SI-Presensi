<?php

namespace App\Http\Controllers;

use App\Models\Kepegawaian;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use RealRashid\SweetAlert\Facades\Alert;



class KepegawaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kepegawaian.index', [
            'title' => 'Kepegawaian',
            'active' => 'Kepegawaian',
            'kepegawaians' => Kepegawaian::paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kepegawaian.create', [
            'title' => 'Tambah Status Kepegawaian',
            'active' => 'Kepegawaian',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKepegawaianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'status_kepegawaian' => 'required|unique:jabatans|max:255',
            ],
            [
                'status_kepegawaian.required' => 'Status kepegawaian harus diisi',
                'status_kepegawaian.unique' => 'Status kepegawaian sudah ada',
                'status_kepegawaian.max' => 'Status kepegawaian maksimal 255 karakter',
            ]
        );
        Kepegawaian::create($data);
        Alert::success('Success', 'Kepegawaian berhasil ditambahkan');
        return redirect()->route('kepegawaian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kepegawaian  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kepegawaian $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kepegawaian  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kepegawaian $kepegawaian)
    {
        return view('kepegawaian.edit', [
            'title' => 'Edit Kepegawaian',
            'active' => 'Kepegawaian',
            'kepegawaian' => $kepegawaian,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKepegawaianRequest  $request
     * @param  \App\Models\Kepegawaian  $kepegawaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kepegawaian $kepegawaian)
    {
        $data = $request->validate(
            [
                'status_kepegawaian' => 'required|unique:kepegawaians|max:255',
            ],
            [
                'status_kepegawaian.required' => 'Status kepegawaian harus diisi',
                'status_kepegawaian.unique' => 'Status kepegawaian sudah ada',
                'status_kepegawaian.max' => 'Status kepegawaian maksimal 255 karakter',
            ]
        );
        Kepegawaian::where('id', $kepegawaian->id)->update($data);
        Alert::success('Success', 'Status Kepegawaian berhasil diubah');
        return redirect()->route('kepegawaian.index')->with('success', 'Kepegawaian berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kepegawaian  $kepegawaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kepegawaian $kepegawaian)
    {
        Kepegawaian::destroy($kepegawaian->id);
        Alert::success('Success', 'Kepegawaian berhasil dihapus');
        return redirect()->route('kepegawaian.index');
    }
}
