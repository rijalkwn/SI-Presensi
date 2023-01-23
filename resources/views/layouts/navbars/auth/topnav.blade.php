<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl mt-1" id="navbarBlur"
    data-scroll="false">
    <div class="me-md-auto pe-md-3 ms-2 d-flex align-items-center bg-white shadow-none border-radius-xl mt-1 px-3 py-1">
        <img src="/img/logos/logo.png" class="navbar-brand-img h-35" style="height: 35px" alt="main_logo">
        <span class="ms-1 font-weight-bold px-2">SI Presensi Karyawan</span>
    </div>
    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Type here...">
        </div>
    </div>
    <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-flex align-items-center">
            <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link text-white font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Log out</span>
                </a>
            </form>
        </li>
        {{-- <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </a>
        </li> --}}
        <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
        </li>
    </ul>
    </div>
    </div>
</nav>
<!-- End Navbar -->
