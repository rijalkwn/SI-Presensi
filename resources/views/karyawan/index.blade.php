@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Karyawan'])
    <div class="container-fluid py-4">
        <div class="row mx-4">
            <div class="col-12">
                <div class="card">
                    <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start">
                        <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"> Data Karyawan </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab-2"> Reset Password
                                Karyawan </a> </li>
                    </ul>
                    <div class="tab-content mb-0 pb-0">
                        <div class="tab-pane fade show active" id="tab-1">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <div class="ms-auto">
                                        <a class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#bulk_add_karyawan">
                                            <i class="fa fa-cloud-download"></i> Import
                                        </a>
                                        <a href="/karyawan/create" class="btn btn-warning btn-sm"><i
                                                class="fa fa-plus-square" aria-hidden="true"></i> Tambah
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-4 py-3">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-striped" id="karyawan">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    No
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    NIK
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                        <div
                                                            class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                            <a href="/karyawan/{{ $karyawan->nik }}/edit"
                                                                class="btn btn-link text-warning mb-0"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form action="/karyawan/{{ $karyawan->nik }}" method="post"
                                                                class="my-auto">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-link text-danger mb-0"
                                                                    onclick="return confirm('Yakin ingin menghapus data ini??')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-2">
                            <div class="card px-3 py-3">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('admin.reset-password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email Karyawan</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <p class="text-danger text-xs fst-italic">*Password karyawan akan di setel ulang yaitu
                                        sesuai NIK*</p>
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Anda yakin untuk melakukan reset password pada karyawan ini?')">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

<!-- Modal Bulk Add Karyawan -->
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="bulk_add_karyawan" tabindex="-1"
    aria-labelledby="bulk_add_karyawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulk_add_karyawanLabel">Import Karyawan</h5>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 mb-3">
                    <div class="text-center">
                        <img src="{{ asset('img/logos/import.png') }}" class="img-fluid" alt="none">
                    </div>
                </div>
                <div class="col-12">
                    Keterangan:
                    <ul>
                        <li>File harus berformat .xlsx, .xls, .csv</li>
                        <li>File harus memiliki header kolom nik, nama, email, status kepegawaian</li>
                        <li>Header kolom harus sesuai dengan contoh</li>
                        <li>Status Kepegawaian hanya tersedia tiga yaitu "Guru Tidak Tetap", "Pegawai Tidak Tetap", dan
                            "Guru Tamu"</li>
                    </ul>
                </div>
                <form action="{{ route('karyawan.bulk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input class="form-control" type="file" id="file" name="file"
                            accept=".xlsx, .xls, .csv" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.2/b-2.3.4/b-html5-2.3.4/datatables.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#karyawan').DataTable({

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
