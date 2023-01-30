@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="card col-lg-10">
            <div class="card-header text-center">
                <h5 class="h3 mb-0">Profile Pegawai</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile_user.update', $karyawan->nik) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group d-sm-flex justify-content-center">
                                <img src="{{ asset('img/profile/default.jpg') }}" alt="" height="150px"
                                    class="avatar-img border border-white border-3 rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- NIK --}}
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    value="{{ $karyawan->nik }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- nama --}}
                            <div class="form-group @error('nama') has-danger @enderror">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ old('nama', $karyawan->nama) }}">
                            </div>
                            @error('nama')
                                <p class="text-danger text-sm fs-6">*{{ $message }}*</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- email --}}
                            <div class="form-group @error('email') has-danger @enderror">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $karyawan->email) }}">
                            </div>
                            @error('email')
                                <p class="text-danger text-sm fs-6">*{{ $message }}*</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- tempat_lahir --}}
                            <div class="form-group @error('tempat_lahir') has-danger @enderror">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                    placeholder="contoh : Kebumen"
                                    value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}">
                            </div>
                            @error('tempat_lahir')
                                <p class="text-danger text-sm fs-6">*{{ $message }}*</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- tanggal_lahir --}}
                            <div class="form-group @error('tanggal_lahir') has-danger @enderror">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                            </div>
                            @error('tanggal_lahir')
                                <p class="text-danger text-sm fs-6">*{{ $message }}*</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- alamat --}}
                            <div class="form-group @error('alamat') has-danger @enderror">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    value="{{ old('alamat', $karyawan->alamat) }}">
                            </div>
                            @error('alamat')
                                <p class="text-danger text-sm fs-6">*{{ $message }}*</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- tmt --}}
                            <div class="form-group @error('tmt') has-danger @enderror">
                                <label for="tmt">TMT</label>
                                <input type="date" name="tmt" id="tmt" class="form-control">
                            </div>
                            @error('tmt')
                                <p class="text-danger text-sm fs-6">*{{ $message }}*</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- status kepegawaian --}}
                            <div
                                class="form-group
                            @error('kepegawaian_id') has-danger @enderror">
                                <label class="form-control-label" for="kepegawaian_id">Status Kepegawaian</label>
                                <select name="kepegawaian_id" id="kepegawaian_id" required
                                    class="form-control
                                @error('jabatan_id') is-invalid @enderror">
                                    <option value="" disabled>Pilih Status Kepegawaian</option>
                                    @foreach ($kepegawaians as $kepegawaian)
                                        <option value="{{ $kepegawaian->id }}"
                                            {{ $karyawan->kepegawaian_id == $kepegawaian->id ? 'selected' : '' }}>
                                            {{ $kepegawaian->status_kepegawaian }}</option>
                                    @endforeach
                                </select>
                                @error('kepegawaian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
