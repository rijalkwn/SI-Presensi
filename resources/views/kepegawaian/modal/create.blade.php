<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="add_kepegawaian" tabindex="-1"
    aria-labelledby="add_karyawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_kepegawaianLabel">Tambah Status Kepegawaian</h5>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/kepegawaian" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div
                                        class="form-group
                                        @error('status_kepegawaian') has-danger @enderror">
                                        <label class="form-control-label" for="status_kepegawaian">Nama Status
                                            Kepegawaian</label>
                                        <input type="text" name="status_kepegawaian" id="status_kepegawaian" required
                                            class="form-control
                                            @error('status_kepegawaian') is-invalid @enderror"
                                            value="{{ old('status_kepegawaian') }}">
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
