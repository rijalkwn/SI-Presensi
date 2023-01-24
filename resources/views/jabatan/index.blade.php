@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Jabatan'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Jabatan</p>
                        <a href="/jabatan/create" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                            data-bs-target="#modaljabatan">Tambah</a>
                    </div>
                </div>
            </div>
            <ul class="#saveform-errList"></ul>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatans as $jabatan)
                                <tr>
                                    <td class="align-middle text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $jabatan->nama_jabatan }}</p>
                                    </td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                            <p class="text-sm font-weight-bold mb-0">Edit</p>
                                            <p class="text-sm font-weight-bold mb-0 ps-2">Delete</p>
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
@endsection

@include('jabatan.modal')

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#add_jabatan', function(e) {
                e.preventDefault();
                var data = {
                    nama_jabatan: $('#nama_jabatan').val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/jabatan',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.status == 400) {
                            $('#saveform-errList').html('');
                            $('#saveform-errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_value) {
                                $('#saveform-errList').append('<li>' + err_value +
                                    '</li>');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
