@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Presensi Pulang'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <form action="{{ route('presensi.pulang.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Presensi Pulang</h5>
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
                                        <label class="form-control-label" for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control" disabled
                                            value="{{ $karyawan->nik }}">
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
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
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
