@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mt-4 mx-4">
            <div class="col-lg-10">
                <form action="/karyawan" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Tambah Karyawan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('nik') has-danger @enderror">
                                        <label class="form-control-label" for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" autofocus required
                                            class="form-control
                                            @error('nik') is-invalid @enderror"
                                            value="{{ old('nik') }}">
                                        @error('nik')
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
                                        <input type="text" name="nama" id="nama" required
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
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('email') has-danger @enderror">
                                        <label class="form-control-label" for="email">Email</label>
                                        <input type="text" name="email" id="email" required
                                            class="form-control
                                            @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">
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
                                        @error('kepegawaian_id') has-danger @enderror">
                                        <label class="form-control-label" for="kepegawaian_id">Status Kepegawaian</label>
                                        <select name="kepegawaian_id" id="kepegawaian_id" required
                                            class="form-control
                                            @error('kepegawaian_id') is-invalid @enderror">
                                            <option>Pilih Status Kepegawaian</option>
                                            @foreach ($kepegawaians as $kepegawaian)
                                                <option value="{{ $kepegawaian->id }}">
                                                    {{ $kepegawaian->status_kepegawaian }}</option>
                                            @endforeach
                                        </select>
                                        @error('kepegawaian_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="/karyawan" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
