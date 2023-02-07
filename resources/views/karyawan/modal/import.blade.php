<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="bulk_add_karyawan" tabindex="-1"
    aria-labelledby="bulk_add_karyawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulk_add_karyawanLabel">Import Karyawan</h5>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 mb-3">
                    <div class="text-center">
                        <img src="{{ asset('img/logos/import.png') }}" class="img-fluid" alt="none">
                    </div>
                </div>
                <div class="col-12">
                    Keterangan:
                    <ul>
                        <li>File harus berformat .xlsx, .xls, .csv</li>
                        <li>File harus memiliki header kolom nik, nama, email, status kepegawaian</li>
                        <li>Header kolom harus sesuai dengan contoh</li>
                        <li>Status Kepegawaian hanya tersedia tiga yaitu "Guru Tidak Tetap", "Pegawai Tidak Tetap", dan
                            "Guru Tamu"</li>
                    </ul>
                </div>
                <form action="{{ route('karyawan.bulk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input class="form-control" type="file" id="file" name="file"
                            accept=".xlsx, .xls, .csv" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
