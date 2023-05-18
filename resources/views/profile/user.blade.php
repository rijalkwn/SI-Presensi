@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="card col-lg-10">
            <div class="card-header text-center mb-3">
                <h5 class="h3 mb-0">Profil {{ Auth::user()->nama }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile_user.update', $karyawan->nik) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="text-center">
                                    <div class="avatar avatar-xxxl">
                                        <img class="avatar-img border border-white border-3 rounded-circle"
                                            style="width: 120px"
                                            src="{{ $karyawan->foto == null ? asset('img/profile/default.jpg') : asset($karyawan->foto) }}"
                                            alt="...">
                                    </div>
                                    <input type="file" id="file" name="file" data-allow-reorder="true">
                                </div>
                            </div>
                            @error('file')
                                <p class="text-danger text-sm fs-6">*{{ $message }}*</p>
                            @enderror
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- NIK --}}
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" name="nik" id="nik" class="form-control"
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
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                    value="{{ $karyawan->tanggal_lahir }}">
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
                                <input type="date" name="tmt" id="tmt" class="form-control"
                                    value="{{ $karyawan->tmt }}">
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
                                @error('kepegawaian_id') is-invalid @enderror">
                                    <option value="" disabled>Pilih Status Kepegawaian</option>
                                    @foreach ($kepegawaians as $kepegawaian)
                                        <option value="{{ $kepegawaian->id }}"
                                            {{ $karyawan->kepegawaian_id == $kepegawaian->id ? 'selected' : '' }}>
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
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <script>
        // disable all input and button after submit
        $('form').submit(function() {
            // show spinner on button
            $(this).find('button[type=submit]').html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...`
            );
            $('button').attr('disabled', 'disabled');
        });
    </script>
@endpush
