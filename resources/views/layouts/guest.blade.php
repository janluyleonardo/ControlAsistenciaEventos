<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Asistencia grados')." - ".env('APP_VERSION', '2.0') }}</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('images/icono-cun.png') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css?V='.now()->format('H.s')) }}">
        <link rel="stylesheet" href="{{ asset('css/welcome.css?V='.now()->format('H.s')) }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css?V='.now()->format('H.s')) }}">
        <link rel="stylesheet" href="{{ asset('css/login.css?V='.now()->format('H.s')) }}">
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
