<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Asistencia grados')." - ".env('APP_VERSION', '2.0') }}</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="{{ asset('images/icono-cun.png') }}" type="image/x-icon">

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css?V='.now()->format('H.s')) }}">
  <link rel="stylesheet" href="{{ asset('css/asisGrados.css?V='.now()->format('H.s')) }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css?V='.now()->format('H.s')) }}">
  <link rel="stylesheet" href="{{ asset('css/inputs.css?V='.now()->format('H.s')) }}">
  <link rel="stylesheet" href="{{ asset('css/carga.css?V='.now()->format('H.s')) }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css?V='.now()->format('H.s')) }}">
  @livewireStyles
  <!-- Scripts -->
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased">
  <x-jet-banner />
  <div id="container_load">
    <div id="load"></div>
  </div>
  <div class="min-h-screen gradient">
    @livewire('navigation-menu')

    @if (isset($header))
    <header class="shadow hd-green">
      <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
    @endif

    <main>
      {{ $slot }}
    </main>
  </div>

  @stack('modals')
  @livewireScripts
  <script>
    window.onload = function() {
      var container_load = document.getElementById('container_load');
      container_load.style.visibility = 'hidden';
      container_load.style.opacity = '0';
    }

    window.onunload = function() {
      console.log('entro en onunload');
      var container_load = document.getElementById('container_load');
      container_load.style.visibility = 'hidden';
      container_load.style.opacity = '0';
    }

    function mostrar() {
      var container_load = document.getElementById('container_load');
      container_load.style.visibility = 'visible';
      container_load.style.opacity = '1';
    }
  </script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
