@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Izin'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <form action="{{ route('presensi.izin.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Izin</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="tanggal">Tanggal</label>
                                        <input type="text" name="tanggal" id="tanggal" disabled class="form-control"
                                            value="{{ $today }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="waktu">Waktu</label>
                                        <input type="time" name="waktu" id="waktu" disabled class="form-control"
                                            value="{{ $time }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control" disabled
                                            value="{{ $karyawan->nik }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control" disabled
                                            value="{{ $karyawan->nama }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- file --}}
                                <div class="col-lg-12">
                                    <div
                                        class="form-group @error('file')
                                        has-danger
                                    @enderror">
                                        <label class="form-control-label" for="file">Surat Izin</label>
                                        <input type="file" name="file" id="file" class="form-control">
                                        <label class="text-danger fst-italic">*Format file [.pdf], pastikan
                                            file
                                            yang
                                            diupload benar.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                                    <button class="btn btn-warning" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
