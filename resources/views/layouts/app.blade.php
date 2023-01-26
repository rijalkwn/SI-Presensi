<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="" sizes="76x76" href="/img/logos/logo.png">
    <link rel="icon" type="image/png" href="/img/logos/logo.png">
    <title>
        SI Presensi
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('assets/css/nucleo-icons.css') }}">
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    {{-- <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ url('assets/css/argon-dashboard.css') }}">
    {{-- icons --}}
</head>

<body class="{{ $class ?? '' }}" onload="realtimeClock()">

    @guest
        @yield('content')
    @endguest

    @auth
        <div class="min-height-500 bg-primary position-absolute w-100"></div>
        @include('layouts.navbars.auth.sidenav')
        <main class="main-content border-radius-lg">
            @yield('content')
        </main>
        {{-- @include('components.fixed-plugin') --}}
    @endauth
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    {{-- jam --}}
    <script src="assets/js/jam.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.js"></script>
    @stack('js');
    @yield('js')
</body>

</html>
