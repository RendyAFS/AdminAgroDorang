<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/Logo/LogoAgroDorang.png') }}">

    <title>{{ $judulpage }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">



    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body class="body">
    @yield('content')
    @vite('resources/js/app.js')
    @stack('scripts')
    @include('sweetalert::alert')
</body>

</html>
