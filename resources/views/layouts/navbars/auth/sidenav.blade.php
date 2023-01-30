<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header mb-2">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            {{-- nama user --}}
            <div class="d-flex align-items-center">
                <div class="avatar avatar-sm avatar-indicators avatar-online">
                    <img src="{{ asset('img/profile/default.jpg') }}" alt="avatar" class="rounded-circle">
                </div>
                <div class="ms-2">
                    <div class="ms-2 mb-0 text-lg font-weight-bold">{{ Auth::user()->nama }}</div>
                    <div class="ms-2">
                        @if (Auth::user()->role == 'admin')
                            <h6 class="mb-0 text-sm">Administrator</h6>
                        @elseif(Auth::user()->role == 'user')
                            <h6 class="mb-0 text-sm">{{ $karyawan->jabatan->nama_jabatan }}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </a>
    </div>
    {{-- <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src="/img/logos/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">SI Presensi Karyawan</span>
        </a>
    </div> --}}
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('history*') ? 'active' : '' }}" href="{{ route('history') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-history text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">History Presensi</span>
                </a>
            </li>
            @if (auth()->user()->role == 'admin')
                <li class="nav-item mt-3 d-flex align-items-center">
                    <h6 class="ms-4 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Administrator</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('karyawan*') ? 'active' : '' }}"
                        href="{{ route('karyawan.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Karyawan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kepegawaian*') ? 'active' : '' }}"
                        href="{{ route('kepegawaian.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-files-o text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Status Kepegawaian</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-3 d-flex align-items-center my-4">
                <h6 class="ms-4 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">My Account</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('') ? 'active' : '' }}" href="/{{ Auth::User()->role }}/profile">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-address-card text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('') ? 'active' : '' }}" href="">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-key text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Password</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
