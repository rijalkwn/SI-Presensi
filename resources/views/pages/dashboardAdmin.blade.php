@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">MASUK</h4>
                                    {{-- jumlah karyawan yang sudah absen --}}
                                    <p class="text-sm text-uppercase my-3 ms-3">{{ $countMasuk }} Karyawan
                                    </p>

                                </div>
                            </div>
                            <div class="col-4 my-auto">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa fa-calendar ntext-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">PULANG</h4>
                                    <p class="text-sm text-uppercase my-3 ms-3">{{ $countPulang }}
                                        Karyawan</p>
                                </div>
                            </div>
                            <div class="col-4 my-auto">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa fa-calendar text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">IZIN</h4>
                                    <p class="text-sm text-uppercase my-3 ms-3">{{ $countIzin }}
                                        Karyawan</p>
                                </div>
                            </div>
                            <div class="col-4 my-auto">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa fa-calendar-times-o text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">SAKIT</h4>
                                    <p class="text-sm text-uppercase my-3 ms-3">{{ $countSakit }}
                                        Karyawan</p>
                                </div>
                            </div>
                            <div class="col-4 my-auto">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa fa-thermometer-full text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mx-4">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">History Presensi Karyawan</p>
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jam Masuk
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Keluar</th>
                                        <th <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Keterangan</th>
                                        <th <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presensiAll as $presensi)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->nip }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->nama }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->jabatan }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->jam_masuk }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->jam_pulang }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{ $presensi->keterangan }}</p>
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
