@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">HADIR</h4>
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
            <div class="col-lg-4 col-sm-6 mb-xl-0 mb-4">
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
            <div class="col-lg-4 col-sm-6 mb-xl-0 mb-4">
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
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">History Presensi Karyawan Hari Ini</p>
                        </div>
                    </div>
                    <div class="card-body px-4 py-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="dashboardAdmin">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIK
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status Kepegawaian
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Masuk
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Pulang
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Keterangan
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presensiAll as $presensi)
                                        <tr>
                                            <td class="text-sm">
                                                <p class="ps-3">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-2 text-sm font-weight-bold mb-0">{{ $presensi->nik }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">{{ $presensi->nama }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">
                                                    {{ $presensi->status_kepegawaian }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ps-2 text-sm font-weight-bold mb-0">{{ $presensi->tanggal }}
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    @if ($presensi->status == 'Hadir')
                                                        <span class="ps-3">{{ $presensi->jam_masuk }}</span>
                                                    @elseif ($presensi->status == 'Izin' || $presensi->status == 'Sakit')
                                                        <span class="badge badge-sm bg-secondary ms-4">--:--:--</span>
                                                    @endif
                                                </p>
                                            </td>
                                            {{-- jam pulang --}}
                                            <td class="text-sm">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    @if ($presensi->status == 'Hadir')
                                                        @if ($presensi->jam_pulang == null)
                                                            <span class="badge badge-sm bg-secondary ms-4">--:--:--</span>
                                                        @else
                                                            <span class="ps-4">{{ $presensi->jam_pulang }}</span>
                                                        @endif
                                                    @elseif ($presensi->status == 'Izin' || $presensi->status == 'Sakit')
                                                        <span class="badge badge-sm bg-secondary ms-4">--:--:--</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="text-sm font-weight-bold mb-0 ps-3">
                                                    @if ($presensi->status == 'Hadir')
                                                        @if ($presensi->jam_masuk > '07:00:00')
                                                            Terlambat
                                                        @else
                                                            Tepat Waktu
                                                        @endif
                                                    @elseif ($presensi->status == 'Izin')
                                                        <span>
                                                            <a href="{{ asset('/files/suratIzin/' . $presensi->surat) }}"
                                                                style="text-decoration: underline; color:cornflowerblue">lihat
                                                                surat
                                                                izin</a>
                                                        </span>
                                                    @elseif ($presensi->status == 'Sakit')
                                                        <span>
                                                            <a href="{{ asset('/files/suratSakit/' . $presensi->surat) }}"
                                                                style="text-decoration: underline; color:cornflowerblue">lihat
                                                                surat sakit</a>
                                                        </span>
                                                    @else
                                                        <span>Tidak Absen</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    @if ($presensi->status == 'Hadir')
                                                        <span class="badge badge-sm bg-success ms-2">Hadir</span>
                                                    @elseif ($presensi->status == 'Izin')
                                                        <span class="badge badge-sm bg-primary ms-2">Izin</span>
                                                    @elseif ($presensi->status == 'Sakit')
                                                        <span class="badge badge-sm bg-info ms-2">Sakit</span>
                                                    @else
                                                        <span class="badge badge-sm bg-danger ms-2">Tidak Absen</span>
                                                    @endif
                                                </p>
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
@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.2/b-2.3.4/b-html5-2.3.4/datatables.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#dashboardAdmin').DataTable({

            });
        });
    </script>
@endpush
