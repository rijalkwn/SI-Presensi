@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Status Kepegawaian'])
    <div class="container-fluid py-4">
        <div class="row mx-4">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-2 pb-2">Status Kepegawaian</p>
                            <a class="btn btn-warning btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#add_kepegawaian">
                                <i class="fa fa-plus-square"></i> Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-hover" id="kepegawaian">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status Kepegawaian
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kepegawaians as $kepegawaian)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0 mx-3">{{ $loop->iteration }}</p>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0 mx-3">
                                                    {{ $kepegawaian->status_kepegawaian }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-end">
                                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                    <a class="btn btn-link text-warning mb-0" id="buttonModalKepegawaian"
                                                        data-bs-toggle="modal" data-bs-target="#kepegawaian_view"
                                                        data-attr="{{ route('kepegawaian.edit', $kepegawaian->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-link text-danger mb-0"
                                                        id="buttonConfirmDelete_kepegawaian" data-bs-toggle="modal"
                                                        data-bs-target="#confirm_delete_kepegawaian"
                                                        data-attr="{{ route('delete_kepegawaian', $kepegawaian->id) }}">
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
        </div>
    </div>
    @include('layouts.footers.auth.footer')
    </div>
@endsection

{{-- modal add kepegawaian --}}
@include('kepegawaian.modal.create')

{{-- modal edit kepegawaian --}}
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="kepegawaian_view" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Status Kepegawaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalKepegawaian">

            </div>
        </div>
    </div>
</div>

{{-- modal delete kepegawaian --}}
<div class="modal fade" data-bs-backdrop="static" id="confirm_delete_kepegawaian" tabindex="-1" role="dialog"
    aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmDeleteLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalConfirmDelete_kepegawaian">

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
            $('#kepegawaian').DataTable({

            });
        });

        // display a modal confirm edit karyawan
        $(document).on("click", "#buttonModalKepegawaian", function(event) {
            event.preventDefault();
            let href = $(this).attr("data-attr");
            $.ajax({
                url: href,
                // return the result
                success: function(result) {
                    $("#kepegawaian_view").modal("show");
                    $("#showModalKepegawaian").html(result).show();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                },
            });
        });
        // display a modal confirm delete karyawan
        $(document).on("click", "#buttonConfirmDelete_kepegawaian", function(event) {
            event.preventDefault();
            let href = $(this).attr("data-attr");
            $.ajax({
                url: href,
                // return the result
                success: function(result) {
                    $("#confirm_delete_kepegawaian").modal("show");
                    $("#showModalConfirmDelete_kepegawaian").html(result).show();
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
