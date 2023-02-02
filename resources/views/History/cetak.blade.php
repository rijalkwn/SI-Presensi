<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cetak</title>
</head>

<body>
    <header>
        <div class="row">
            <div class="col-3">
                <img src="{{ asset('files/profile/logo_sma.png') }}" alt="" style="height: 120px">
            </div>
            <div class="col-9 text-right">
                <h3>DATA PRESENSI KARYAWAN SMA NEGERI 1 PREMBUN</h3>
                <h6>Jl. Raya Wadaslintang No.12, Tersobo Satu, Sidogede, Kec. Prembun,</h6>
                <h5>Kabupaten Kebumen, Jawa Tengah 54394</h5>
            </div>
        </div>
    </header>
    <main>
        <div class="row mx-3">
            <table class="table table-bordered" style="border: 1px solid black">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Status Kepegawaian</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Pulang</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->status_kepegawaian }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jam_masuk }}</td>
                            <td>{{ $item->jam_pulang }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <div class="row">
            <div class="col-4 me-auto">
                <p>Mengetahui,</p>
                <p>(Kepala Sekolah)</p>
                <br><br><br>
                <p>Nama Kepala Sekolah</p>
                <p>NIP: ____________</p>
            </div>
            <div class="col-4"></div>
            <div class="col-4 ms-auto">
                <p>Prembun, 12 Maret 2023</p>
                <p>Petugas Absensi</p>
                <br><br><br>
                <p>Nama Petugas Absensi</p>
                <p>NIP: ____________</p>
            </div>
        </div>
    </footer>
</body>

</html>
