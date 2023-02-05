@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        @error('PresensiError')
            <div class="alert alert-info">{{ $message }}</div>
        @enderror
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <a href="{{ route('presensi.masuk') }}">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">MASUK</h4>
                                    </div>
                                </div>
                                <div class="col-4 my-auto">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fa fa-calendar ntext-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <a href="{{ route('presensi.pulang') }}">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">PULANG</h4>
                                    </div>
                                </div>
                                <div class="col-4 my-auto">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fa fa-calendar text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <a href="{{ route('presensi.izin') }}" method>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">IZIN</h4>
                                    </div>
                                </div>
                                <div class="col-4 my-auto">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fa fa-calendar-times-o text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <a href="{{ route('presensi.sakit') }}">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h4 class="text-lg text-uppercase font-weight-bold my-3 ms-3">SAKIT</h4>
                                    </div>
                                </div>
                                <div class="col-4 my-auto">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fa fa-thermometer-full text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">History Presensi Minggu Ini</p>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NO
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Masuk
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jam Pulang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Keterangan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($presensis->count() == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <p class="text-xl font-weight-bold mb-0">Data tidak ditemukan</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($presensis as $presensi)
                                            <tr>
                                                <td class="text-sm">
                                                    <p class="ps-3">{{ $loop->iteration }}</p>
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
                                                                <span
                                                                    class="badge badge-sm bg-secondary ms-4">--:--:--</span>
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
                                                            @if ($presensi->jam_masuk > $setting->jam_masuk)
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
                                                    <p class="text-sm font-weight-bold mb-0 ms-3">
                                                        @if ($presensi->status == 'Hadir')
                                                            <span class="badge badge-sm bg-success">Hadir</span>
                                                        @elseif ($presensi->status == 'Izin')
                                                            <span class="badge badge-sm bg-primary">Izin</span>
                                                        @elseif ($presensi->status == 'Sakit')
                                                            <span class="badge badge-sm bg-info">Sakit</span>
                                                        @else
                                                            <span class="badge badge-sm bg-danger">Tidak Absen</span>
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 mb-2 mx-3">
                            {{ $presensis->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
