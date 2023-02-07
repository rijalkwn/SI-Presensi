@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Sakit'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <form action="{{ route('presensi.sakit.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Sakit</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- file --}}
                                <div class="col-lg-12">
                                    <div
                                        class="form-group @error('file')
                                        has-danger
                                    @enderror">
                                        <label class="form-control-label" for="file">Surat Sakit</label>
                                        <input type="file" name="file" id="file" class="form-control">
                                        <label class="text-danger fst-italic">*Format file [.pdf], pastikan
                                            file
                                            yang
                                            diupload benar.</label>
                                    </div>
                                    @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
