<form action="/kepegawaian/{{ $kepegawaian->id }}" method="post">
    @method('put')
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group
                        @error('status_kepegawaian') has-danger @enderror">
                        <label class="form-control-label" for="status_kepegawaian">Status
                            Kepegawaian</label>
                        <input type="text" name="status_kepegawaian" id="status_kepegawaian" required
                            class="form-control
                            @error('status_kepegawaian') is-invalid @enderror"
                            value="{{ $kepegawaian->status_kepegawaian }}">
                        @error('status_kepegawaian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
