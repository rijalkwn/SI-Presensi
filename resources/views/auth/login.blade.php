@extends('layouts.app')
@section('content')
    <main>
        <div class="container-login">
            <div class="row justify-content-center align-item-center">
                <div class="col-lg-10 col-md-10 col-sm-12 py-md-5">
                    <div class="row shadow">
                        @error('loginError')
                            <div class="col-lg-12 p-4">
                                <div class="alert alert-danger">{{ $message }}</div>
                            </div>
                        @enderror
                        <div class="col-lg-6 col-md-6 col-sm-12 p-4 order-1 order-md-0">
                            <div class="text-center text-md-start">
                                <img src="{{ asset('img/logos/logos.png') }}" class="img-fluid mb-3 ml-md-4 ml-sm-5"
                                    width="60px" alt="Logo">
                                <p class="mb-0">Selamat Datang</p>
                                <h4 style="font-weight: bolder;">di SI-Presensi Karyawan</h4>
                                <p style="font-size: small; color: grey;">merupakan aplikasi untuk presensi karyawanan SMA
                                    Negeri 1 Prembun</p>
                            </div>
                            <form class="mb-3 mt-md-3" action="/login" method="POST">
                                @csrf
                                <!-- Identifier -->
                                <div class="mb-3">
                                    <label class="form-label" style="font-size: small"> NIM atau Email <span
                                            style="color: red;">*</span></label>
                                    <input type="text" class="form-control" style="font-size: small" id="identifier"
                                        name="identifier" placeholder="Masukkan NIM atau Email"
                                        value="{{ old('identifier') }}" required>
                                </div>
                                <!-- Password -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" style="font-size: small"> Password <span
                                            style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control fakepassword" style="font-size: small"
                                            id="password" name="password" placeholder="Masukkan Password" required>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 p-0 p-md-0 order-1 order-md-0 ms-auto">
                            <img src="{{ asset('img/logos/p.jpg') }}" style="width: 536px" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
