@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'History Presensi'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">History Presensi Karyawan</p>
                            <div class="ms-auto d-flex">
                                <form action="{{ route('history.admin') }}" method="get" class="me-3">
                                    <select name="bulan" onchange="this.form.submit()" class="form-select me-3 bg-info">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1" {{ $selectedMonth == 1 ? 'selected' : '' }}>Januari
                                        </option>
                                        <option value="2" {{ $selectedMonth == 2 ? 'selected' : '' }}>Februari
                                        </option>
                                        <option value="3" {{ $selectedMonth == 3 ? 'selected' : '' }}>Maret</option>
                                        <option value="4" {{ $selectedMonth == 4 ? 'selected' : '' }}>April</option>
                                        <option value="5" {{ $selectedMonth == 5 ? 'selected' : '' }}>Mei</option>
                                        <option value="6" {{ $selectedMonth == 6 ? 'selected' : '' }}>Juni</option>
                                        <option value="7" {{ $selectedMonth == 7 ? 'selected' : '' }}>Juli</option>
                                        <option value="8" {{ $selectedMonth == 8 ? 'selected' : '' }}>Agustus
                                        </option>
                                        <option value="9" {{ $selectedMonth == 9 ? 'selected' : '' }}>September
                                        </option>
                                        <option value="10" {{ $selectedMonth == 10 ? 'selected' : '' }}>Oktober
                                        </option>
                                        <option value="11" {{ $selectedMonth == 11 ? 'selected' : '' }}>November
                                        </option>
                                        <option value="12" {{ $selectedMonth == 12 ? 'selected' : '' }}>Desember
                                        </option>
                                    </select>
                                </form>
                                {{-- <a href="{{ route('history.cetak') }}" target="_blank" class="btn btn-sm btn-primary"><i
                                        class="fa fa-print" aria-hidden="true"></i> Cetak</a> --}}
                                <form action="{{ route('history.cetak') }}" method="get" target="_blank" class="me-3">
                                    @csrf
                                    <input type="hidden" name="bulan" value="{{ $selectedMonth }}">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"
                                            aria-hidden="true"></i> Cetak</button>
                                </form>
                                <form action="{{ route('history.destroy') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Anda akan menghapus semua data. Anda yakin?')"><i
                                            class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NO
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NIK
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama
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
                                        @foreach ($data as $presensi)
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
