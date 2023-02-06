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
                                {{-- export excel --}}
                                <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#bulk_presensi">
                                    <i class="fa fa-cloud-upload"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="historyAdmin">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presensis as $presensi)
                                        <tr>
                                            <td class="text-sm">
                                                <p class="ps-3">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-2 text-sm font-weight-bold mb-0">{{ $presensi->nik }}
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">{{ $presensi->nama }}
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">
                                                    {{ $presensi->status_kepegawaian }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ps-2 text-sm font-weight-bold mb-0">
                                                    {{ $presensi->tanggal }}
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
                                                        <span class="badge badge-sm bg-danger ms-2">Tidak
                                                            Absen</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td>
                                                <form action="/history/{{ $presensi->id }}" method="POST" class="my-auto">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger my-auto"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
<!-- Modal Bulk Add Karyawan -->
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="bulk_presensi" tabindex="-1"
    aria-labelledby="bulk_presensiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulk_presensiLabel">Export Presensi</h5>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('export-excel') }}" method="get" class="me-3">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6"><label for="bulan">Bulan</label>
                            <select name="bulan" class="form-select me-3">
                                <option value="" disabled>Pilih Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-lg-6"<label for="tahun">Tahun</label>
                            <select name="tahun" class="form-select me-3">
                                <option value="" disabled>Pilih Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 ms-auto d-flex">
                            <button type="submit" class="btn btn-success mt-3 ms-auto">Export</button>
                        </div>
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
            $('#historyAdmin').DataTable({});
        });
    </script>
@endpush
