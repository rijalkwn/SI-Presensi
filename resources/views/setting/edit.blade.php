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
                                    <div
                                        class="form-group
                                        @if (isset($setting->jam_pulang)) {{ $setting->jam_pulang }}
                                                @else @endif">
                                        <label class="form-control-label" for="jam_pulang">Jam Pulang</label>
                                        <input type="time" name="jam_pulang" id="jam_pulang" required
                                            class="form-control
                                            @error('latitude') has-danger @enderror"
                                            value="{{ old('jam_pulang', $setting->jam_pulang) }}">
                                        @error('jam_pulang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="form-control-label">Lokasi Sekolah</label>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                        @error('latitude') has-danger @enderror">
                                                <label for="latitude" class="form-control-label">Latitude</label>
                                                <input type="latitude" name="latitude" id="latitude" placeholder="latitude"
                                                    required
                                                    class="form-control
                                            @error('latitude') is-invalid @enderror"
                                                    value="{{ old('latitude', $setting->latitude) }}">
                                                @error('latitude')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                        @error('longitude') has-danger @enderror">
                                                <label for="longitude" class="form-control-label">Longitude</label>
                                                <input type="longitude" name="longitude" id="longitude" required
                                                    class="form-control
                                            @error('longitude') is-invalid @enderror"
                                                    value="{{ old('longitude', $setting->longitude) }}">
                                                @error('longitude')
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
                                        <input type="number" name="radius" id="radius" required
                                            class="form-control
                                            @error('radius') is-invalid @enderror"
                                            value="{{ old('radius', $setting->radius) }}">
                                        @error('radius')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="text-xs text-danger">*Satuan Kilometer (contoh: 0.05 KM = 50
                                            Meter)*</span>
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
