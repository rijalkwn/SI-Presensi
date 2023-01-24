@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Presensi Masuk'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Presensi Masuk</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group @error('tanggal') has-danger @enderror">
                                        <label class="form-control-label" for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" readonly value=""
                                            class="form-control
                                            @error('tanggal') is-invalid @enderror"
                                            value="{{ old('tanggal') }}">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group @error('jam') has-danger @enderror">
                                        <label class="form-control-label" for="jam">Jam</label>
                                        <input type="time" name="jam" id="jam" readonly
                                            class="form-control
                                            @error('jam') is-invalid @enderror"
                                            value="{{ old('jam') }}">
                                        @error('jam')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('nip') has-danger @enderror">
                                        <label class="form-control-label" for="nip">NIP</label>
                                        <input type="text" name="nip" id="nip"
                                            class="form-control
                                            @error('nip') is-invalid @enderror"
                                            value="{{ old('nip') }}">
                                        @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('nama') has-danger @enderror">
                                        <label class="form-control-label" for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama"
                                            class="form-control
                                            @error('nama') is-invalid @enderror"
                                            value="{{ old('nama') }}">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
