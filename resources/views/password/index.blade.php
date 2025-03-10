@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Change password'])
    <div class="container-fluid py-4">
        <div class="card col-lg-10">
            <div class="card-header">
                <h5 class="mb-0">Change Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('password.update', $user->nik) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-1">
                        <label for="old_password">Password Lama:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                id="old_password" name="old_password" required>
                            @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="new_password">Password Baru:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                id="new_password" name="new_password" required>
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="ver_password">Verifikasi Password Baru:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control @error('ver_password') is-invalid @enderror"
                                id="ver_password" name="ver_password" required>
                            @error('ver_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-end">
                            <button type="submit" class="btn btn-sm btn-warning mt-2 mb-0">Ubah Password</button>
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
