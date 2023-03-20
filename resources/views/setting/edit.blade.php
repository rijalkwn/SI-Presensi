@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Setting Presensi'])
    <div class="container-fluid py-4">
        <div class="row mx-4">
            <div class="col-lg-12">
                <form action="{{ route('setting.update', $setting->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Setting Presensi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('jam_masuk') has-danger @enderror">
                                        <label class="form-control-label" for="jam_masuk">Jam Masuk</label>
                                        <input type="time" name="jam_masuk" id="jam_masuk" required
                                            class="form-control
                                            @error('jam_masuk') is-invalid @enderror"
                                            value="{{ old('jam_masuk', $setting->jam_masuk) }}">
                                        @error('jam_masuk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div
                                            class="form-group
                                            @if (isset($setting->jam_pulang_senin_kamis)) {{ $setting->jam_pulang_senin_kamis }}
                                                    @else @endif">
                                            <label class="form-control-label" for="jam_pulang_senin_kamis">Jam Pulang <span class="text-warning">*Hari Senin - Kamis</span></label>
                                            <input type="time" name="jam_pulang_senin_kamis" id="jam_pulang_senin_kamis" required
                                                class="form-control
                                                @error('jam_pulang_senin_kamis') has-danger @enderror"
                                                value="{{ old('jam_pulang_senin_kamis', $setting->jam_pulang_senin_kamis) }}">
                                            @error('jam_pulang_senin_kamis')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                            class="form-group
                                            @if (isset($setting->jam_pulang_jumat)) {{ $setting->jam_pulang_jumat }}
                                                    @else @endif">
                                            <label class="form-control-label" for="jam_pulang_jumat">Jam Pulang <span class="text-warning">*Hari Jumat</span></label>
                                            <input type="time" name="jam_pulang_jumat" id="jam_pulang_jumat" required
                                                class="form-control
                                                @error('jam_pulang_jumat') has-danger @enderror"
                                                value="{{ old('jam_pulang_jumat', $setting->jam_pulang_jumat) }}">
                                            @error('jam_pulang_jumat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                        @error('lat') has-danger @enderror">
                                                <label class="form-control-label" for="lat">Latitude Lokasi
                                                    Sekolah</label>
                                                <input type="text" name="lat" id="lat" required
                                                    class="form-control
                                            @error('lat') is-invalid @enderror"
                                                    value="{{ old('lat', $setting->lat) }}">
                                                @error('lat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                        @error('lng') has-danger @enderror">
                                                <label class="form-control-label" for="lng">Longitude Lokasi
                                                    Sekolah</label>
                                                <input type="text" name="lng" id="lng" required
                                                    class="form-control
                                            @error('lng') is-invalid @enderror"
                                                    value="{{ old('lng', $setting->lng) }}">
                                                @error('lng')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('radius') has-danger @enderror">
                                        <label class="form-control-label" for="radius">Radius</label>
                                        <input type="text" name="radius" id="radius" required
                                            class="form-control
                                            @error('radius') is-invalid @enderror"
                                            value="{{ old('radius', $setting->radius) }}">
                                        @error('radius')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-warning">Update</button>
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
