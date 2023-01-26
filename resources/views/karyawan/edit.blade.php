@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mt-4 mx-4">
            <div class="col-lg-10">
                <form action="/karyawan/{{ $karyawan->nip }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Edit Karyawan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nip">NIP</label>
                                        <input type="text" readonly class="form-control" value="{{ $karyawan->nip }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('nama') has-danger @enderror">
                                        <label class="form-control-label" for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" required
                                            class="form-control
                                            @error('nama') is-invalid @enderror"
                                            value="{{ $karyawan->nama }}">
                                        @error('nama')
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
                                        @error('email') has-danger @enderror">
                                        <label class="form-control-label" for="email">Email</label>
                                        <input type="email" name="email" id="email" required
                                            class="form-control
                                            @error('email') is-invalid @enderror"
                                            value="{{ $karyawan->email }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('jabatan_id') has-danger @enderror">
                                        <label class="form-control-label" for="jabatan_id">Jabatan</label>
                                        <select name="jabatan_id" id="jabatan_id" required
                                            class="form-control
                                            @error('jabatan_id') is-invalid @enderror">
                                            <option value="" disabled>Pilih Jabatan</option>
                                            @foreach ($jabatans as $jabatan)
                                                <option value="{{ $jabatan->id }}"
                                                    {{ $karyawan->jabatan_id == $jabatan->id ? 'selected' : '' }}>
                                                    {{ $jabatan->nama_jabatan }}</option>
                                            @endforeach
                                        </select>
                                        @error('jabatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <a href="/karyawan" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-warning">Submit</button>
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
