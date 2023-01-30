@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-scroller">

        @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])

        <main>

            <!-- Container START -->
            <div class="container">
                <div class="row g-4">
                    <!-- Main content START -->
                    <div class="col-md-8 col-lg-6 vstack gap-4">
                        <!-- Card START -->
                        <div class="card">
                            <!-- Card header START -->
                            <div
                                class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                                <h1 class="card-title h5">Profile</h1>
                                <div class="small italic text-danger">Lengkapi data diri anda dengan benar</div>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-1 mb-1">
                                        <div class="form-group">
                                            <div class="text-center">
                                                <div class="avatar avatar-xxxl">
                                                    <img class="avatar-img border border-white border-3 rounded-circle"
                                                        src="" alt="...">
                                                </div>
                                                <input type="file" class="file" id="fileProfile" name="fileProfile"
                                                    data-allow-reorder="true">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Form Nama --}}
                                    <div class="row mt-1 mb-1">
                                        <label class="col-sm-2 col-form-label text-dark">Nama :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" name="nama" placeholder="Nama" value="" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Form nip --}}
                                    <div class="row mb-1">
                                        <label class="col-sm-2 col-form-label text-dark">NIP :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nip" name="nip"
                                                placeholder="nip" value="" readonly required>
                                        </div>
                                    </div>

                                    {{-- Form Status --}}
                                    <div class="row mb-1">
                                        <label class="col-sm-2 col-form-label text-dark">Status :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="status" name="status"
                                                placeholder="Status" value="" readonly required>
                                        </div>
                                    </div>

                                    {{-- Form Nomor HP --}}
                                    <div class="row mb-1">
                                        <label class="col-sm-2 col-form-label text-dark">Nomor HP :</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('handphone') is-invalid @enderror" id="handphone"
                                                name="handphone" placeholder="Nomor HP" value="" required>
                                            @error('handphone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Form Email SSO --}}
                                    <div class="row mb-1">
                                        <label class="col-sm-2 col-form-label text-dark">Email SSO :</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Email" value="" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Form Alamat --}}
                                    <div class="row mb-1">
                                        <label class="col-sm-2 col-form-label text-dark">Alamat :</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat"
                                                required></textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-sm btn-primary mt-2 mb-0">Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Card body END -->
                        </div>
                        <!-- Card END -->
                    </div>

                </div> <!-- Row END -->
            </div>
            <!-- Container END -->
        </main>
    </div>
@endsection
