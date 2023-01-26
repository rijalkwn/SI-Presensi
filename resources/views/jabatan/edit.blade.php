@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mt-4 mx-4">
            <div class="col-lg-10">
                <form action="/jabatan/{{ $jabatan->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Edit Jabatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div
                                        class="form-group
                                        @error('nama_jabatan') has-danger @enderror">
                                        <label class="form-control-label" for="nama_jabatan">Nama Jabatan</label>
                                        <input type="text" name="nama_jabatan" id="nama_jabatan" required
                                            class="form-control
                                            @error('nama_jabatan') is-invalid @enderror"
                                            value="{{ $jabatan->nama_jabatan }}">
                                        @error('nama_jabatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="/jabatan" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-warning">Update</button>
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
