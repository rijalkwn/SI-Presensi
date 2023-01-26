@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Jabatan'])
    <div class="container-fluid py-4">
        <div class="row mt-4 mx-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Jabatan</p>
                            <a href="/jabatan/create" class="btn btn-primary btn-sm ms-auto">Tambah</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                    <a href="/jabatan/{{ $jabatan->id }}/edit"
                                                        class="btn btn-link text-warning mb-0"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form action="/jabatan/{{ $jabatan->id }}" method="post">
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
            </div>
        </div>
    </div>
@endsection
