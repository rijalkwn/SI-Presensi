@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mt-4 mx-4">
            <div class="col-lg-10">
                <form action="/kepegawaian/{{ $kepegawaian->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Edit Status Kepegawaian</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div
                                        class="form-group
                                        @error('status_kepegawaian') has-danger @enderror">
                                        <label class="form-control-label" for="status_kepegawaian">Status
                                            Kepegawaian</label>
                                        <input type="text" name="status_kepegawaian" id="status_kepegawaian" required
                                            class="form-control
                                            @error('status_kepegawaian') is-invalid @enderror"
                                            value="{{ $kepegawaian->status_kepegawaian }}">
                                        @error('status_kepegawaian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="/kepegawaian" class="btn btn-secondary">Batal</a>
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
