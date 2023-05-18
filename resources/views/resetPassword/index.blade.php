@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Reset Password Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mx-4">
            <div class="col-9">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Reset Password Karyawan</h4>
                    </div>
                    <div class="card-body px-4 py-3">
                        <div class="alert alert-info text-white mx-2 my-2">Password akan direset sesuai dengan NIK dari
                            karyawan
                            tersebut!!</div>
                        <div class="card px-2 py-3">
                            <form method="POST" action="{{ route('reset-password') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="nik">NIK Karyawan</label>
                                    <input id="nik" type="numeric"
                                        class="form-control @error('nik') is-invalid @enderror" name="nik"
                                        value="{{ old('nik') }}" required>
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi">Konfirmasi NIK Karyawan</label>
                                    <input id="konfirmasi" type="numeric"
                                        class="form-control @error('konfirmasi') is-invalid @enderror" name="konfirmasi"
                                        value="{{ old('konfirmasi') }}" required>
                                    @error('konfirmasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#resetPasswordModal" id="resetPasswordButton">Reset</button> --}}
                                <button type="submit" class="btn btn-success">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

{{-- modal confirm reset --}}
{{-- <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Konfirmasi Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin melakukan reset password pada karyawan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" id="resetPasswordButton">Reset</button>
            </div>
        </div>
    </div>
</div> --}}


@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        //confirm reset password
        document.getElementById("resetPasswordButton").addEventListener("click", function() {
            document.querySelector("form").submit();
        });

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
