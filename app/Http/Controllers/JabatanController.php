<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJabatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validated = Validator::make($request->all(), [
        //     'nama' => 'required',
        //     'gaji_pokok' => 'required',
        //     'tunjangan' => 'required',
        // ]);

        // // if ($validated->fails()) {
        // //     return response()->json([
        // //         'status' => 400,
        // //         'message' => 'error',
        // //         'errors' => $validated->message(),
        // //     ]);
        // } else {
        //     $jabatan = new Jabatan;
        //     $jabatan->nama_jabatan = $request->input('nama_jabatan');
        //     $jabatan->save();
        //     return response()->json([
        //         'status' => 200,
        //         'errrors' => 'Jabatan Added Successfully',
        //     ]);
        // }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }
}
