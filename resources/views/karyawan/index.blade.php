@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mx-4">
            <div class="col-9">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Data Karyawan</h4>
                        <div class="d-flex align-items-center">
                            <div class="ms-auto">
                                {{-- <a class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#bulk_add_karyawan">
                                            <i class="fa fa-cloud-download"></i> Import
                                        </a> --}}
                                {{-- tambah karyawan --}}
                                <a href="{{ route('karyawan.create') }}" class="btn btn-danger">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 py-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-striped" id="karyawan">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NIK
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Email
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status Kepegawaian</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $karyawan)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0 ms-3">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $karyawan->nik }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $karyawan->nama }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $karyawan->email }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $karyawan->kepegawaian->status_kepegawaian }}</p>
                                            </td>
                                            <td class="align-middle text-end">
                                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                    <a class="btn btn-link text-warning mb-0" id="buttonModalKaryawan"
                                                        data-bs-toggle="modal" data-bs-target="#karyawan_view"
                                                        data-attr="{{ route('karyawan.edit', $karyawan->nik) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-link text-danger mb-0"
                                                        id="buttonConfirmDelete_karyawan" data-bs-toggle="modal"
                                                        data-bs-target="#confirm_delete_karyawan"
                                                        data-attr="{{ route('delete_karyawan', $karyawan->nik) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Jumlah User</h4>
                    </div>
                    <div class="card-body d-flex p-3 bg-success align-items-center">
                        <div class="card p-3 me-2 mx-auto text-center flex-fill">
                            <p>Admin</p>
                            <p>{{ $countAdmin }}</p>
                        </div>
                        <div class="card p-3 ms-2 mx-auto text-center flex-fill">
                            <p>Karyawan</p>
                            <p>{{ $countUser }}</p>
                        </div>
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
