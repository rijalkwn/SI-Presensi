@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Izin'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h3 mb-0">Izin</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group @error('tanggal') has-danger @enderror">
                                        <label class="form-control-label" for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" disabled value=""
                                            class="form-control
                                            @error('tanggal') is-invalid @enderror"
                                            value="{{ old('tanggal') }}">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group @error('jam') has-danger @enderror">
                                        <label class="form-control-label" for="jam">Jam</label>
                                        <input type="time" name="jam" id="jam" disabled
                                            class="form-control
                                            @error('jam') is-invalid @enderror"
                                            value="{{ old('jam') }}">
                                        @error('jam')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nip">NIP</label>
                                        <input type="text" name="nip" id="nip" class="form-control" disabled
                                            value="{{ $karyawan->nip }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control" disabled
                                            value="{{ $karyawan->nama }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div
                                        class="form-group
                                        @error('surat') has-danger @enderror">
                                        <label class="form-control-label dropzone" for="file">Surat Izin</label>
                                        <input type="file" class="filepond" id="file" name="file"
                                            data-allow-reorder="true" required>
                                        @error('surat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-">
                                    <button class="btn btn-warning" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@section('js')
    <script>
        // disable all input and button after submit
        $('form').submit(function() {
            // show spinner on button
            $(this).find('button[type=submit]').html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...`
            );
            $('button').attr('disabled', 'disabled');
        });
    </script>
    <!-- Load FilePond library -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

    <!-- Turn all file input elements into ponds -->
    <script>
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize
        );
        FilePond.create(document.getElementById('file'), {
            maxParallelUploads: 1,
            maxFileSize: "15MB",
            acceptedFileTypes: ['application/pdf'],
            labelIdle: 'Drag & Drop your files or <span class="filepond--label-action link">Browse</span>',
            stylePanelAspectRatio: 0.2,
        });

        // Send the files to the Controller
        FilePond.setOptions({
            server: {
                url: '/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endsection
