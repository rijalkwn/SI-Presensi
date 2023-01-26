@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Presensi Masuk'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Presensi Masuk</h5>
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
                                        <label class="form-control-label" for="nip">NIP</label>
                                        <input type="text" name="nip" id="nip" class="form-control" disabled
                                            value="{{ $karyawan->nip }}">
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
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('foto') has-danger @enderror">
                                        <label class="form-control-label" for="foto">Foto</label>
                                        <input type="file" name="foto" id="foto"
                                            class="form-control
                                            @error('foto') is-invalid @enderror"
                                            value="{{ old('foto') }}">
                                        @error('foto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-control-label" for="">Lokasi</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div
                                                class="form-group
                                        @error('latitude_masuk') has-danger @enderror">
                                                <input type="text" name="latitude_masuk" id="latitude_masuk" disabled
                                                    class="form-control @error('latitude_masuk') is-invalid @enderror"
                                                    value="{{ old('latitude_masuk') }}" placeholder="Latitude">
                                                @error('latitude_masuk')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div
                                                class="form-group
                                        @error('longitude_masuk') has-danger @enderror">
                                                <input type="text" name="longitude_masuk" id="longitude_masuk" disabled
                                                    class="form-control @error('longitude_masuk') is-invalid @enderror"
                                                    value="{{ old('longitude_masuk') }}" placeholder="Longitude">
                                                @error('longitude_masuk')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-">
                                    <button class="btn btn-warning" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
