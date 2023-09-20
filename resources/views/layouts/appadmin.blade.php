<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo/LogoArgoDorang.png') }}">
    <title>{{ $judulpage }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">



    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- <style>
        /* CSS */
        .sidebar {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
            width: 250px;
            height: 95%;
            background-color: #333;
            color: #fff;
            overflow-y: auto;
            padding: 20px;
            border-radius: 15px
        }

        .topbar {
            display: none;
            /* Sembunyikan topbar secara default */
            background-color: #333;
            color: #fff;
            padding: 10px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            /* Pastikan topbar muncul di atas konten */
        }

        @media screen and (max-width: 768px) {
            .topbar {
                display: block;
            }

            .sidebar {
                display: none;
                /* Sembunyikan sidebar pada tampilan seluler */
            }

            .content {
                margin-top: 50px;
                /* Atur margin atas pada konten untuk memberikan ruang bagi topbar */
            }
        }

        @media screen and (min-width: 769px) {
            .sidebar {
                display: block;
            }

            .topbar {
                display: none;
                /* Sembunyikan topbar pada tampilan desktop */
            }

            .content {
                margin-top: 0;
                margin-left: 250px;
                /* Sesuaikan dengan lebar sidebar */
                /* Atur margin atas pada konten ke nilai semula */
            }
        }

        .content {
            padding: 30px;
            /* Berikan padding agar konten tidak berdekatan dengan sidebar */
        }

        .sidebar .logout {

        }

        body {
            /*  */
        }
    </style> --}}
</head>

<body class="body">
    @yield('content')
    @vite('resources/js/app.js')
    @stack('scripts')
    @include('sweetalert::alert')
</body>

</html>
