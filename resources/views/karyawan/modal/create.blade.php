<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="add_karyawan" tabindex="-1"
    aria-labelledby="add_karyawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_karyawanLabel">Tambah Karyawan</h5>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/karyawan" method="post">
                    @csrf
                    <div class="card">
                        <div class="alert alert-info text-sm-center text-white">!Password dibuat secara default sesuai
                            NIK dari
                            masing
                            masing
                            karyawan</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('nik') has-danger @enderror">
                                        <label class="form-control-label" for="nik">NIK</label>
                                        <input type="number" name="nik" id="nik" required autofocus
                                            class="form-control
                                            @error('nik') is-invalid @enderror"
                                            value="{{ old('nik') }}">
                                        @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('nama') has-danger @enderror">
                                        <label class="form-control-label" for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" required
                                            class="form-control
                                            @error('nama') is-invalid @enderror"
                                            value="{{ old('nama') }}">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('email') has-danger @enderror">
                                        <label class="form-control-label" for="email">Email</label>
                                        <input type="text" name="email" id="email" required
                                            class="form-control
                                            @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div
                                        class="form-group
                                        @error('kepegawaian_id') has-danger @enderror">
                                        <label class="form-control-label" for="kepegawaian_id">Status
                                            Kepegawaian</label>
                                        <select name="kepegawaian_id" id="kepegawaian_id" required
                                            class="form-control
                                            @error('kepegawaian_id') is-invalid @enderror">
                                            <option disabled>Pilih Status Kepegawaian</option>
                                            @foreach ($kepegawaians as $kepegawaian)
                                                <option value="{{ $kepegawaian->id }}">
                                                    {{ $kepegawaian->status_kepegawaian }}</option>
                                            @endforeach
                                        </select>
                                        @error('kepegawaian_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-end">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-warning"
                                        id="buttonModalAddKaryawan">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
