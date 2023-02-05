@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Presensi Masuk'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <form action="{{ route('presensi.masuk.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Presensi Masuk</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" id="lat" name="lat">
                                    <input type="hidden" id="lng" name="lng">
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
                                    <button class="btn btn-warning" id="absenMasuk" type="submit">Submit</button>
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
    <!-- Datatables -->
    <script src="{{ asset('/assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable();
        });

        window.setTimeout(function() {
            document.getElementById('absenMasuk').removeAttribute('disabled')
        }, 2000);

        getLocation();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert('Geolocation tidak didukung oleh peramban ini');
            }
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            document.getElementById('latTest').value = lat;
            document.getElementById('lngTest').value = lng;
        }
    </script>


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
