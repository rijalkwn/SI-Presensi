@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <img src="{{ asset('img/logos/logos.png') }}" class="img-fluid mb-3 ml-md-4 ml-sm-5"
                                        width="60px" alt="Logo">
                                    <p class="mb-0">Selamat Datang</p>
                                    <h4 style="font-weight: bolder;">di E-Presensi Karyawan</h4>
                                    <p style="font-size: small; color: grey;">merupakan aplikasi untuk presensi karyawan
                                        SMA
                                        Negeri 1 Prembun</p>
                                </div>
                                <div class="card-body">
                                    @error('loginError')
                                        <div class="alert alert-danger text-white font-weight-bold text-center">
                                            {{ $message }}</div>
                                    @enderror
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <label class="form-label" style="font-size: small"> NIK atau Email <span
                                                    style="color: red;">*</span></label>
                                            <input type="text" name="identifier" class="form-control form-control-lg"
                                                required>
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <label class="form-label" style="font-size: small">Password<span
                                                    style="color: red;">*</span></label>
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                aria-label="Password" required>
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <a class="text-sm text-gray-600 hover:text-gray-900"
                                                style="text-decoration: underline" data-bs-toggle="modal"
                                                {{-- cursor tangan --}} style="cursor: pointer;"
                                                data-bs-target="#bulk_presensi"> Lupa Password?
                                            </a>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('img/logos/background.jpg');
              background-size: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

<!-- Modal Lupa Password-->
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="bulk_presensi" tabindex="-1"
    aria-labelledby="bulk_presensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulk_presensiLabel">Pesan</h5>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Untuk lupa password, silahkan hubungi admin.</p>
                {{-- btn close --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
