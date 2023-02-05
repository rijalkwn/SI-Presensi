@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@push('css')
    <style>
        #map {
            height: 500px;
            width: 100%;
        }

        .custom-map-control-button {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            height: 40px;
            cursor: pointer;
        }

        .custom-map-control-button:hover {
            background: #ebebeb;
        }
    </style>
@endpush
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Lokasi Anda'])
    <div class="container-fluid py-4">
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card my-3 px-3 py-3">
                                <h5>Lokasi Anda</h5>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('javascript')
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiCgqFCjR9uNOe1BJ9-QN8-SS6r6d07Ik&callback=initMap&libraries=&v=weekly"
        async></script>

    <script type="text/javascript">
        let map, infoWindow;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -7.718488746500309,
                    lng: 109.7938869160373
                },
                zoom: 16,
            });
            infoWindow = new google.maps.InfoWindow();

            const locationButton = document.createElement("button");

            locationButton.textContent = "Ketuk untuk melihat lokasi anda";
            locationButton.classList.add("custom-map-control-button");
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
            locationButton.addEventListener("click", () => {
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            infoWindow.setPosition(pos);
                            infoWindow.setContent("Lokasi ditemukan!");
                            infoWindow.open(map);
                            map.setCenter(pos);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Peramban tidak mendukung geolokasi
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: Layanan Geolokasi Gagal." :
                "Error: Peramban anda tidak mendukung layanan geolokasi."
            );
            infoWindow.open(map);
        }
    </script>
@endpush
