@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="card col-lg-10">
            <div class="card-header text-center">
                <h5 class="h3 mb-0">Profile</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile_admin.update', $user->id) }}" method="post">
                    @csrf
                    @method('put')
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            {{-- input file ptofil --}}
                    {{-- <div class="form-group d-sm-flex justify-content-center">
                        <img src="{{ asset('img/profile/default.jpg') }}" alt="" height="150px"
                            class="avatar-img border border-white border-3 rounded-circle">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="form-group">
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- NIK --}}
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    value="{{ $user->nik }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- nama --}}
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ $user->nama }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            {{-- email --}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Save</button>
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
