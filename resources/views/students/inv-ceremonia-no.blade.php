<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>invitación de {{ Str::title($name) }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="{{ env('APP_URL') }}css/certificados.css" rel="stylesheet">
  {{-- FONTS GOOGLE --}}
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,500&display=swap" rel="stylesheet">

</head>

<body>
  <header>
    <img class="img-header" src="{{ env('APP_URL') }}images/certificados/Invitacion-header-ventanilla.jpeg" alt="header invitacion">
  </header>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-5 text-center nombre">
          <strong>{{ Str::title($name) }}</strong>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body text-center">
              <a href="{{ $url_validate }}"><img src="data:image/svg+xml;base64, {!! base64_encode($qr) !!}" /></a>
              <br>
              @if ($silla == '')

              @else
              <strong>Silla: </strong>{{$silla}}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-center">
          <strong>Fecha:</strong>
          {{ $fechaPrint }}<br>
          <strong>Hora:</strong>
          {{$horaFormat}}<br>
          <strong>Lugar:</strong>
          @switch($lugar)
              @case('Auditorio Mayor CUN - Calle 23, 6-19')
                <a id="location" href="{{__('Bogota')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Santa Marta')
                <a id="location" href="{{__('Santa Marta')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Barranquilla')
                <a id="location" href="{{__('Sede Barranquilla')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Chía')
                <a id="location" href="{{__('Sede Chía')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Florencia')
                <a id="location" href="{{__('Sede Florencia')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Ibagué')
                <a id="location" href="{{__('Sede Ibagué')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Ipiales')
                <a id="location" href="{{__('Sede Ipiales')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Montería')
                <a id="location" href="{{__('Sede Montería')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Neiva')
                <a id="location" href="{{__('Sede Neiva')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Sincelejo')
                <a id="location" href="{{__('Sede Sincelejo')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @case('Sede Yopal')
                <a id="location" href="{{__('Sede Yopal')}}" Target="_blank">
                  {{$lugar}}
                  <img src="https://cdn-icons-png.flaticon.com/512/2991/2991231.png" alt="icono-maps" srcset="maps" width="32" height="32">
                </a>
                @break
              @default
          @endswitch
        </div>
      </div>
    </div>
  </main>
  <footer>
    <img class="img-footer" src="{{ env('APP_URL') }}images/certificados/Invitacion-footer.jpg" alt="footer invitacion">
  </footer>
</body>

</html>
