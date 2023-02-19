@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'History Presensi'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">History Presensi Karyawan</p>
                            <div class="ms-auto d-flex mb-2">
                                {{-- export excel --}}
                                <a class="btn btn-success btn-sm my-auto mx-2" data-bs-toggle="modal"
                                    data-bs-target="#bulk_presensi">
                                    <i class="fa fa-cloud-upload"></i> Export Excel
                                </a>
                                <a class="btn btn-danger btn-sm my-auto mb-0" id="buttonConfirmDelete_history"
                                    data-bs-toggle="modal" data-bs-target="#confirm_delete_history"
                                    data-attr="{{ route('delete_history', 'all') }}">
                                    <i class="fa fa-trash"></i> Hapus Semua
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
                                            Foto
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
                                                    {{ $presensi->tanggal ? \Carbon\Carbon::parse($presensi->tanggal)->format('d F Y') : 'Tidak Ada Tanggal' }}
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
                                            @if ($presensi->status == 'Hadir')
                                                <td data-image="{{ $presensi->foto_masuk }}">
                                                    <a href="{{ asset('img/presensi/masuk/' . $presensi->foto_masuk) }}"
                                                        target="_blank">Lihat Foto</a>
                                                    {{-- <br><img id="image-preview" src="" style="display: none;"
                                                        width="200" height="200"> --}}
                                                </td>
                                            @else
                                                <td">Tidak Ada Foto</td>
                                            @endif
                                            {{-- keterangan --}}
                                            <td class="text-sm">
                                                <p class="text-sm font-weight-bold mb-0 ps-3">
                                                    @if ($presensi->status == 'Hadir')
                                                        <span>{{ $presensi->keterangan }}</span>
                                                    @elseif ($presensi->status == 'Izin')
                                                        <span>
                                                            <a href="{{ asset('/files/suratIzin/' . $presensi->surat) }}"
                                                                target="_blank"
                                                                style="text-decoration: underline; color:cornflowerblue">lihat
                                                                surat
                                                                izin</a>
                                                        </span>
                                                    @elseif ($presensi->status == 'Sakit')
                                                        <span>
                                                            <a href="{{ asset('/files/suratSakit/' . $presensi->surat) }}"
                                                                target="_blank"
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
                                                <a class="btn btn-link text-danger mb-0" id="buttonConfirmDelete_history"
                                                    data-bs-toggle="modal" data-bs-target="#confirm_delete_history"
                                                    data-attr="{{ route('delete_history', $presensi->id) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <div id="chart"></div>
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
                        <div class="col-lg-4 ms-auto d-flex">
                            <button type="submit" class="btn btn-success mt-3 ms-auto">Export</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- modal delete presensi --}}
<div class="modal fade" data-bs-backdrop="static" id="confirm_delete_history" tabindex="-1" role="dialog"
    aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmDeleteLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalConfirmDelete_history">

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
            $('#historyAdmin').DataTable({});
        });

        var data = <?= json_encode($data) ?>;

        data = data.map(function(item) {
            return item.count;
        });

        Highcharts.chart('chart', {
            title: {
                text: 'Presensi Karyawan Keseluruhan'
            },
            xAxis: {
                categories: ['Hadir', 'Izin', 'Sakit']
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false
                    },
                    shadow: false,
                    center: ['50%', '50%'],
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Status',
                data: data,
                type: 'column',
                colorByPoint: true,
                colors: ['#00c292', '#00a5e3', '#f46a6a']
            }],
            credits: {
                enabled: false
            },
            exporting: {
                enabled: true
            }
        });

        function showImage(event) {
            event.preventDefault();
            var imageUrl = event.target.href;
            var imagePreview = document.getElementById("image-preview");
            imagePreview.src = imageUrl;
            imagePreview.style.display = "block";
        }

        // display a modal confirm delete karyawan
        $(document).on("click", "#buttonConfirmDelete_history", function(event) {
            event.preventDefault();
            let href = $(this).attr("data-attr");
            $.ajax({
                url: href,
                // return the result
                success: function(result) {
                    $("#confirm_delete_history").modal("show");
                    $("#showModalConfirmDelete_history").html(result).show();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                },
            });
        });
    </script>
@endpush
