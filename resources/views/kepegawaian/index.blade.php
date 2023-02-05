@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Jabatan'])
    <div class="container-fluid py-4">
        <div class="row mt-4 mx-4">
            <div class="col-lg-9">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Status Kepegawaian</p>
                            <a href="/kepegawaian/create" class="btn btn-primary btn-sm ms-auto">Tambah</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-hover">
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
                                                    <a href="/kepegawaian/{{ $kepegawaian->id }}/edit"
                                                        class="btn btn-link text-warning mb-0"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form action="/kepegawaian/{{ $kepegawaian->id }}" method="post">
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
                            <p class="text-danger text-xs ms-4 mt-4 alert">*Jangan menghapus data status kepegawaian ini
                                apabila masih ada
                                karyawan
                                yang
                                memiliki
                                status kepegawaian yang
                                akan dihapus*</p>
                        </div>
                        <div class="mt-4 mb-2 mx-3">
                            {{ $kepegawaians->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
    </div>
@endsection
