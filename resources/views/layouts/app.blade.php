<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="" sizes="76x76" href="/img/logos/logos.png">
    <link rel="icon" type="image/png" href="/img/logos/logos.png">
    <title>
        SI Presensi | {{ $title ?? '' }}
    </title>

    {{-- css bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link rel="stylesheet" href="{{ url('assets/css/nucleo-icons.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/nucleo-svg.css') }}" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ url('assets/css/argon-dashboard.css') }}">
    {{-- filepond --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

</head>

<body class="{{ $class ?? '' }}">

    @guest
        @yield('content')
    @endguest

    @auth
        <div class="min-height-500 bg-primary position-absolute w-100" style="z-index: -999">
        </div>
        @include('layouts.navbars.auth.sidenav')
        <main class="main-content border-radius-lg">
            @yield('content')
        </main>
    @endauth

    {{-- jam --}}
    <script src="{{ url('assets/js/jam.js') }}"></script>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('assets/js/argon-dashboard.js') }}"></script>
    {{-- filepond
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> --}}

    @stack('js');
    @yield('js')
    @include('sweetalert::alert')
</body>

</html>
