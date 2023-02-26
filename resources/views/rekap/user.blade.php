@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Rekap Presensi'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Rekap Presensi Karyawan</p>
                            <div class="ms-auto d-flex mb-2">
                                {{-- export excel --}}
                                {{-- <a class="btn btn-success btn-sm my-auto mx-2" data-bs-toggle="modal"
                                    data-bs-target="#bulk_presensi">
                                    <i class="fa fa-cloud-upload"></i> Export Excel
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="rekapPresensi">
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
                                            Bulan
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Hadir Tepat Waktu
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Hadir Terlambat
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Belum Presensi Pulang
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Izin </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sakit </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekaps as $rekap)
                                        <tr>
                                            <td class="text-sm">
                                                <p class="ps-3">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-2 text-sm font-weight-bold mb-0">{{ $rekap->nik }}
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">{{ $rekap->nama }}
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">
                                                    {{ $rekap->status_kepegawaian }}
                                                </p>
                                            </td>
                                            <td class="text-sm">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">
                                                    @if ($rekap->bulan == 1)
                                                        Januari {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 2)
                                                        Februari {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 3)
                                                        Maret {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 4)
                                                        April {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 5)
                                                        Mei {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 6)
                                                        Juni {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 7)
                                                        Juli {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 8)
                                                        Agustus {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 9)
                                                        September {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 10)
                                                        Oktober {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 11)
                                                        November {{ $rekap->tahun }}
                                                    @elseif($rekap->bulan == 12)
                                                        Desember {{ $rekap->tahun }}
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="text-sm text-center">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">
                                                    {{ $rekap->hadir_tepat_waktu }}
                                                </p>
                                            </td>
                                            <td class="text-sm text-center">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">{{ $rekap->hadir_terlambat }}
                                                </p>
                                            </td>
                                            <td class="text-sm text-center">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">
                                                    {{ $rekap->tidak_presensi_pulang }}
                                                </p>
                                            </td>
                                            <td class="text-sm text-center">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">{{ $rekap->izin }}
                                                </p>
                                            </td>
                                            <td class="text-sm text-center">
                                                <p class="ms-3 text-sm font-weight-bold mb-0">{{ $rekap->sakit }}
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
<!-- Modal Bulk Export Presensi -->
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm btn-success">Export</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.2/b-2.3.4/b-html5-2.3.4/datatables.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#rekapPresensi').DataTable({});
        });
    </script>
@endpush
