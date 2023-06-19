@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mx-4">
            <div class="col-9">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Tambah Karyawan</h4>
                    </div>
                    <div class="card-body px-4 py-3">
                        <form action="/karyawan" method="post">
                            @csrf
                            <div class="card">
                                <div class="alert alert-info text-sm-center text-white">!Password dibuat secara default
                                    sesuai
                                    NIK dari
                                    masing
                                    masing
                                    karyawan</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                                @error('nik') has-danger @enderror">
                                                <label class="form-control-label" for="nik">NIK</label>
                                                <input type="number" name="nik" id="nik" required autofocus
                                                    class="form-control
                                                    @error('nik') is-invalid @enderror"
                                                    value="{{ old('nik') }}">
                                                @error('nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                                @error('nama') has-danger @enderror">
                                                <label class="form-control-label" for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" required
                                                    class="form-control
                                                    @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama') }}">
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                                @error('email') has-danger @enderror">
                                                <label class="form-control-label" for="email">Email</label>
                                                <input type="text" name="email" id="email" required
                                                    class="form-control
                                                    @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group
                                                @error('kepegawaian_id') has-danger @enderror">
                                                <label class="form-control-label" for="kepegawaian_id">Status
                                                    Kepegawaian</label>
                                                <select name="kepegawaian_id" id="kepegawaian_id" required
                                                    class="form-control
                                                    @error('kepegawaian_id') is-invalid @enderror">
                                                    <option disabled>Pilih Status Kepegawaian</option>
                                                    @foreach ($kepegawaians as $kepegawaian)
                                                        <option value="{{ $kepegawaian->id }}">
                                                            {{ $kepegawaian->status_kepegawaian }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kepegawaian_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-end">
                                            <button type="submit" class="btn btn-warning"
                                                id="buttonModalAddKaryawan">Submit</button>
                                        </div>
                                    </div>
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

<!-- Modal Import Add Karyawan -->
@include('karyawan.modal.import')


<!-- Modal Edit Karyawan -->
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="karyawan_view" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalKaryawan">

            </div>
        </div>
    </div>
</div>

{{-- modal delete karyawan --}}
<div class="modal fade" data-bs-backdrop="static" id="confirm_delete_karyawan" tabindex="-1" role="dialog"
    aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmDeleteLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalConfirmDelete_karyawan">

            </div>
        </div>
    </div>
</div>

{{-- modal confirm reset --}}
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
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
                <button type="submit" class="btn btn-success">Reset</button>
            </div>
        </div>
    </div>
</div>


@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.2/b-2.3.4/b-html5-2.3.4/datatables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#karyawan').DataTable({

            });
        });

        // display a modal confirm edit karyawan
        $(document).on("click", "#buttonModalKaryawan", function(event) {
            event.preventDefault();
            let href = $(this).attr("data-attr");
            $.ajax({
                url: href,
                // return the result
                success: function(result) {
                    $("#karyawan_view").modal("show");
                    $("#showModalKaryawan").html(result).show();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                },
            });
        });
        // display a modal confirm delete karyawan
        $(document).on("click", "#buttonConfirmDelete_karyawan", function(event) {
            event.preventDefault();
            let href = $(this).attr("data-attr");
            $.ajax({
                url: href,
                // return the result
                success: function(result) {
                    $("#confirm_delete_karyawan").modal("show");
                    $("#showModalConfirmDelete_karyawan").html(result).show();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                },
            });
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
