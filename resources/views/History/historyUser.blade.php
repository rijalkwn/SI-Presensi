@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'History Presensi'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">History Presensi</p>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIP
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jabatan
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Masuk
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Keluar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Keterangan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presensis as $presensi)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->nip }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->nama }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->jabatan }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->jam_masuk }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    @if ($presensi->jam_keluar == '')
                                                        <span class="badge badge-sm bg-danger">Tidak Absen
                                                        </span>
                                                    @else
                                                        {{ $presensi->jam_keluar }}
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    @if ($presensi->keterangan != 'Terlambat')
                                                        <span class="badge badge-sm bg-success">Tepat Waktu</span>
                                                    @else
                                                        <span class="badge badge-sm bg-danger">Terlambat</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->status }}</p>
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
        @include('layouts.footers.auth.footer')
    </div>
@endsection
