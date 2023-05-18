<form action="/karyawan/{{ $karyawan->nik }}" method="post">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="nik">NIK</label>
                        <input type="number" class="form-control" name="nik" id="nik" readonly
                            value="{{ $karyawan->nik }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group
                        @error('nama') has-danger @enderror">
                        <label class="form-control-label" for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" required
                            class="form-control
                            @error('nama') is-invalid @enderror"
                            value="{{ $karyawan->nama }}">
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
                    <div class="form-group
                        @error('email') has-danger @enderror">
                        <label class="form-control-label" for="email">Email</label>
                        <input type="email" name="email" id="email" required
                            class="form-control
                            @error('email') is-invalid @enderror"
                            value="{{ $karyawan->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group
                        @error('kepegawaian_id') has-danger @enderror">
                        <label class="form-control-label" for="kepegawaian">Status
                            Kepegawaian</label>
                        <select name="kepegawaian_id" id="kepegawaian_id" required
                            class="form-control
                            @error('kepegawaian_id') is-invalid @enderror">
                            <option value="" disabled>Pilih Status Kepegawaian</option>
                            @foreach ($kepegawaians as $kepegawaian)
                                <option value="{{ $kepegawaian->id }}"
                                    {{ $karyawan->kepegawaian_id == $kepegawaian->id ? 'selected' : '' }}>
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
            <div class="row mt-4">
                <div class="col-lg-12 text-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
