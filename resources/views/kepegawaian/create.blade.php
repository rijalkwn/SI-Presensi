@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mt-4 mx-4">
            <div class="col-lg-10">
                <form action="/kepegawaian" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Tambah Status Kepegawaian</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div
                                        class="form-group
                                        @error('status_kepegawaian') has-danger @enderror">
                                        <label class="form-control-label" for="status_kepegawaian">Nama Status
                                            Kepegawaian</label>
                                        <input type="text" name="status_kepegawaian" id="status_kepegawaian" required
                                            class="form-control
                                            @error('status_kepegawaian') is-invalid @enderror"
                                            value="{{ old('status_kepegawaian') }}">
                                        @error('status_kepegawaian')
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
