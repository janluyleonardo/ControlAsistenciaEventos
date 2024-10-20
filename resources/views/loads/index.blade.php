<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Loads list') }}
    </h2>
  </x-slot>

  @if(Auth::user()->current_team_id === 1)
  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 py-2">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="card">
              <div class="card-header">
                Cargar registro de graduandos
                <a href="{{ env('APP_URL') }}carga-registro.xlsx"><strong>ejemplo</strong></a>
              </div>
              <div class="card-body">
                <form action="{{ route('load') }}" method="POST" enctype="multipart/form-data" novalidate>
                  <div class="row">
                    @csrf
                    <x-file></x-file>
                    <div class="col-md-12 text-center mx-auto mt-2">
                      <button class="sombra btn btn-cun" width="50%" type="submit" onclick="mostrar()">{{ __('Load certificate records') }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      <div class="container">
        <div class="row mt-2">
          @if ($conteosPorHora==null)
          @else
          <div class="col-md-6 m-auto">
            <div class="card bg-light mb-2 shadow">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-12 py-2">
                    <strong>Control de asistentes a ceremonia</strong>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <table class="table text-center align-middle table-striped table-hover table-sm ">
                    <thead>
                      <tr>
                        <th>Hora</th>
                        <th>Citados</th>
                        <th>Asistentes</th>
                        <th>Pendientes</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($conteosPorHora as $hora => $conteos)
                        <tr>
                          <td data-label="Hora">{{ $hora }}</td>
                          <td data-label="Citados">{{ $conteos['citados'] }}</td>
                          <td data-label="Asistentes">{{ $conteos['asistentes'] }}</td>
                          <td data-label="Pendientes">{{ $conteos['citados'] - $conteos['asistentes'] }}</td>
                          @if(Auth::user()->current_team_id === 1)
                            <td data-label="Admin">
                              <a class="btn btn-danger sombra " href="{{route('cierre',[$hora])}}" onclick="mostrar()">
                                <i class="bi bi-x-square"> {{__('Close')}} ceremonia</i>
                              </a>
                            </td>
                          @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="card bg-light mb-2">
            <div class="card-header">
              {{ __('Records loads in database') . ': ' . count($loadscount) }}
            </div>
            <div class="card-body">
              <form action="" method="get">
                <div class="row">
                  <div class="col-md-5 m-auto"></div>
                  <div class="col-md-3 m-auto">
                    <a class="btn btn-warning sombra" href="{{route('report')}}">
                      <i class="bi bi-download"></i> {{__('Export User Data')}}
                    </a>
                  </div>
                  <div class="col-md-1 m-auto">
                    <input type="submit" class="sombra btn btn-cun" value="{{__('Search')}}">
                  </div>
                  <div class="col-md-3 m-auto">
                    <input type="text" class="form-control" name="texto" id="texto" value="{{ $texto }}">
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="table-responsive">
                  @if ($loads->isEmpty())
                    <div class="col-md-6 mx-auto mt-3 text-center">
                      <strong>{{ __('No data to show') }}</strong>
                    </div>
                  @else
                    <table class="table align-middle table-striped table-hover table-sm mt-3">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Nombres</th>
                          <th>Correo graduando</th>
                          <th>Documento</th>
                          <th>Carrera</th>
                          <th>Ceremonia</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                      </thead>
                      <tbody>
                        @php
                          $i = 1;
                        @endphp
                        @foreach ($loads as $load)
                          <tr>
                            <td data-label="#">{{ $i }}</td>
                            <td data-label="Nombres">{{ Str::title($load->NOMBRES) }}</td>
                            <td data-label="Correo">{{ $load->CORREO }}</td>
                            <td data-label="Documento">{{ $load->CODIGO_UNICO }}</td>
                            <td data-label="Carrera">{{ $load->CARRERA_TITULO }}</td>
                            <td data-label="Carrera">{{ $load->CEREMONIA }}</td>
                            <td data-label="Fecha">{{ $load->FECHA }}</td>
                            <td data-label="Hora">{{ $load->HORA }}</td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="sombra btn btn-sm btn-info" href="{{route('validateQr',[$load->id])}}">
                                  <i class="bi bi-eye"></i>
                                </a>
                                @if(Auth::user()->current_team_id === 1)
                                  <a class="sombra btn btn-sm btn-warning" href="#editModal{{ $load->id }}" data-bs-toggle="modal">
                                    <i class="bi bi-pencil"></i>
                                  </a>
                                  <a class="sombra btn btn-sm btn-danger" href="#deleteModal{{ $load->id }}" data-bs-toggle="modal">
                                    <i class="bi bi-trash"></i>
                                  </a>
                                @endif
                              </div>
                            </td>
                          </tr>
                          @php
                            $i += +1;
                          @endphp
                          <!-- editModal -->
                          <div class="modal fade" id="editModal{{ $load->id }}" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                              <div class="modal-content sombra">
                                  <form action="{{ route('loads.update', $load->id) }}" method="post" class="requires-validation" novalidate>
                                    @method('put')
                                    @csrf
                                    <div class="modal-header text-center">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        <strong>{{ Str::title($load->NOMBRES) }}</strong>
                                      </h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label=""></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-9">
                                          <strong>Nombre del graduando:</strong>
                                        </div>
                                        <div class="col-md-3">
                                          <strong>Silla:</strong>
                                        </div>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control" name="NOMBRES" id="NOMBRES" value="{{ old('NOMBRES', Str::title($load->NOMBRES)) }}">
                                        </div>
                                        <div class="col-md-3">
                                          <input type="text" class="form-control" name="SILLA" id="SILLA" value="{{ old('SILLA', Str::title($load->SILLA)) }}">
                                        </div>
                                        <div class="col-md-12">
                                          <strong>Correo del graduando:</strong>
                                        </div>
                                        <div class="col-md-12">
                                          <input type="text" class="form-control" name="CORREO" id="CORREO" value="{{ old('CORREO', $load->CORREO) }}">
                                        </div>
                                        <div class="col-md-7">
                                          <strong>Tipo de documento:</strong>
                                        </div>
                                        <div class="col-md-5">
                                          <strong>N° documento:</strong>
                                        </div>
                                        <div class="col-md-7">
                                          @php
                                            $ccSelect = $load->TIPO_DOCUMENTO == 'CC' ? 'selected' : '';
                                            $tiSelect = $load->TIPO_DOCUMENTO == 'TI' ? 'selected' : '';
                                            $ceSelect = $load->TIPO_DOCUMENTO == 'CE' ? 'selected' : '';
                                            $deSelect = $load->TIPO_DOCUMENTO == 'documento de extrangería' ? 'selected' : '';
                                            $paSelect = $load->TIPO_DOCUMENTO == 'pasaporte' ? 'selected' : '';
                                            $rcSelect = $load->TIPO_DOCUMENTO == 'registro civil' ? 'selected' : '';
                                          @endphp
                                          <select class="form-control select-buscar" id="TIPO_DOCUMENTO" name="TIPO_DOCUMENTO" required>
                                            <option value="" hidden selected>Selecciona tipo de documento</option>
                                            <option value="CC" {{ $ccSelect }}>Cédula de ciudadanía</option>
                                            <option value="TI" {{ $tiSelect }}>Tarjeta de identidad</option>
                                            <option value="CE" {{ $ceSelect }}>Cédula de extranjería</option>
                                          </select>
                                        </div>
                                        <div class="col-md-5">
                                          <input type="text" class="form-control" name="CODIGO_UNICO" id="CODIGO_UNICO" value="{{ old('CODIGO_UNICO', $load->CODIGO_UNICO) }}">
                                        </div>
                                        <div class="col-md-4">
                                          <strong>Fecha:</strong>
                                        </div>
                                        <div class="col-md-4">
                                          <strong>Hora:</strong>
                                        </div>
                                        <div class="col-md-4">
                                          <strong>Ceremonia:</strong>
                                        </div>
                                        <div class="col-md-4">
                                          <input type="date"class="form-control" name="FECHA" id="FECHA"value="{{ old('FECHA', $load->FECHA) }}">
                                        </div>
                                        <div class="col-md-4">
                                          <input type="text" class="form-control" name="HORA" id="HORA" value="{{ old('HORA', $load->HORA) }}">
                                        </div>
                                        <div class="col-md-4">
                                          <input type="text" class="form-control" name="CEREMONIA" id="CEREMONIA" value="{{ old('CEREMONIA', $load->CEREMONIA) }}">
                                        </div>
                                        <div class="col-md-12">
                                          <strong>Lugar:</strong>
                                        </div>
                                        <div class="col-md-12">
                                          <input type="text" class="form-control" name="LUGAR" id="LUGAR" value="{{ old('LUGAR', $load->LUGAR) }}">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="sombra btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                      <button type="submit" class="sombra btn btn-success" onclick="mostrar()">{{ __('Save changes') }}</button>
                                    </div>
                                  </form>
                              </div>
                            </div>
                          </div>
                          <!-- Modal delete-->
                          <div class="modal fade" id="deleteModal{{ $load->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content sombra">
                                <div class="modal-header bn-100">
                                  <h1 class="fs-4">
                                    Eliminar registro
                                  </h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                  Esta segura de eliminar el registro de:<br>
                                  <strong>{{ Str::upper($load->NOMBRES) }}</strong>
                                </div>
                                <div class="modal-footer bn-100">
                                  <button type="button" class=" sombra btn btn-warning" data-bs-dismiss="modal">Close</button>
                                  <form action="{{ route('loads.destroy',$load) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class=" sombra btn btn-danger" onclick="mostrar()">
                                        Eliminar registro
                                    </button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </tbody>
                    </table>
                  @endif
                </div>
              </div>
              <div class="card-footer">
                {{ $loads->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
