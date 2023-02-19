@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Izin'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0">PULANG</h5>
                    </div>
                    <div class="card-body">
                        <!-- alert success dan error -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('presensi.masuk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- file --}}
                                <div class="col-lg-12">
                                    <div class="webcam-capture"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn" id="take">Ambil Gambar</button>
                                    <div class="result ms-3"></div>
                                    <input type="text" id="img" name="img" hidden>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <input type="text" id="lokasi" hidden>
                                    <input type="text" id="lat" name="lat" hidden>
                                    <input type="text" id="lng" name="lng" hidden>
                                    <input type="text" id="lat_fix" name="lat_fix" value="{{ $setting->lat }}" hidden>
                                    <input type="text" id="lng_fix" name="lng_fix" value="{{ $setting->lng }}" hidden>
                                    <input type="text" id="radius" name="radius" value="{{ $setting->radius }}"
                                        hidden>
                                    <input type="text" id="jarak" name="jarak" hidden>
                                    <div id="map"></div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-warning submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@push('javascript')
    {{-- webcam --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"
        integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('.webcam-capture');


        //capture
        $('#take').click(function() {
            Webcam.snap(function(data_uri) {
                showResult('<img src="' + data_uri + '"/>');
                $('#img').val(data_uri);
            });
        });

        //menampilkan hasil capture
        function showResult(result) {
            $('.result').html(result);
        }

        //lokasi saat ini
        var lokasi = document.getElementById("lokasi");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            lokasi.innerHTML = "Geolocation is not supported by this browser.";
        }

        function successCallback(position) {
            var lat_fix = document.getElementById("lat_fix").value;
            var lng_fix = document.getElementById("lng_fix").value;
            var radius = document.getElementById("radius").value;

            lokasi.value = position.coords.latitude + ", " + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([lat_fix, lng_fix], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.3,
                radius: radius
            }).addTo(map);

            // hitung jarak map dengan marker1  
            var jarak = map.distance([position.coords.latitude, position.coords.longitude], [lat_fix, lng_fix]);

            // // cek jarak
            // if (jarak > radius) {
            //     $('.submit').attr('disabled', true);
            // } else {
            //     $('.submit').attr('disabled', false);
            // }

            $('#lat').val(position.coords.latitude);
            $('#lng').val(position.coords.longitude);
            $('#jarak').val(jarak);
        }

        function errorCallback(error) {
            if (error.code == 1) {
                lokasi.innerHTML = "You've decided not to share your position, but it's OK. We won't ask you again.";
            } else if (error.code == 2) {
                lokasi.innerHTML = "The network is down or the positioning service can't be reached.";
            } else if (error.code == 3) {
                lokasi.innerHTML = "The attempt timed out before it could get the location data.";
            } else {
                lokasi.innerHTML = "Geolocation failed due to unknown error.";
            }
        }
    </script>
@endpush
