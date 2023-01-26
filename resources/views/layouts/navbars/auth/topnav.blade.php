<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-2 shadow-none border-radius-xl mt-1 py-2" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" class="">
            <ol class="breadcrumb bg-white mb-0 pb-0 pt-1 px-1 me-sm-6 me-5">
                {{-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">judul</li> --}}
                <img src="{{ url('/img/logos/logos.png') }}" class="navbar-brand-img h-35" style="height: 35px"
                    alt="main_logo">
                <span class="ms-1 font-weight-bold px-2 py-2">SI Presensi Karyawan</span>
            </ol>
            {{-- <h6 class="font-weight-bolder text-white mb-0">judul</h6> --}}
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4 py-2" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group me-4 fs-5">
                    <span class="d-sm-inline d-none text-md" id="clock" style="color: white"></span>
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link text-white font-weight-bold px-0"
                            onclick="return confirm('Anda akan logout, Yakin?')">
                            <i class="fa fa-sign-out me-sm-1"></i>
                        </a>
                    </form>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                {{-- <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
