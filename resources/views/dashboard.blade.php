<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        {{-- inicio acordion --}}
        <div class="accordion" id="accordionExample">
          @if (!$informeCeremonias->isEmpty())
            <div class="accordion-item">
              <h1 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Informe Ceremonias
                </button>
              </h1>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <table class="table align-middle table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Fecha ceremonia</th>
                        <th>Hora ceremonia</th>
                        <th>total citados</th>
                        <th>Asistentes</th>
                        <th>Pendientes</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($informeCeremonias as $item)
                      <tr>
                        <td data-label="Fecha ceremonia">{{ $item->Fecha_Ceremonia }}</td>
                        <td data-label="Hora ceremonia">{{ $item->Hora_Ceremonia }}</td>
                        <td data-label="total citados">{{ $item->Total_Citados }}</td>
                        <td data-label="Asistentes">{{ $item->sum_Asistentes }}</td>
                        <td data-label="Pendientes">{{ $item->Total_Citados - $item->sum_Asistentes }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot class="text-center">
                      <tr>
                        <td colspan="5">
                          <a class="btn btn-cun sombra" href="{{route('ceremonies')}}">
                            <i class="bi bi-printer-fill"> {{__('Print')}}Informe Ceremonias</i>
                          </a>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          @else
            {{-- <div class="accordion-item">
              <div class="accordion-header text-center">
                Informe de ceremonias
              </div>
              <div class="accordion-body text-center">
                no tenemos datos para mostrar, en el informe de ceremonias
              </div>
            </div> --}}
          @endif
          @if (!$informeAsistencias->isEmpty())
          <div class="accordion-item">
            <h1 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Informe Asistencias
              </button>
            </h1>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table align-middle table-striped table-hover table-sm">
                  <thead>
                    <tr>
                      <th>Fecha ceremonia</th>
                      <th>Estudiantes citados</th>
                      <th>Asistencia con invitados</th>
                      <th>Estudiantes asistentes</th>
                      <th>Invitados asistentes</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($informeAsistencias as $item)
                      <tr>
                        <td data-label="Fecha ceremonia">{{ $item->FECHA }}</td>
                        <td data-label="Estudiantes citados">{{ $item->estudiantes_citados }}</td>
                        <td data-label="Asistencia con invitados">{{ $item->asistencia_con_invitados }}</td>
                        <td data-label="Estudiantes asistentes">{{ $item->estudiantes_asistentes }}</td>
                        <td data-label="Invitados asistentes">{{ $item->invitados_asistentes }}</td>
                      </tr>
                    @empty
                      <tr></tr>
                    @endforelse
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="5">
                        <a class="btn btn-cun sombra" href="{{route('assistance')}}">
                          <i class="bi bi-printer-fill"> {{__('Print')}}Informe Asistencias</i>
                        </a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          @else
            {{-- <div class="accordion-item mt-2">
              <div class="accordion-header text-center">
                Informe de asistencias
              </div>
              <div class="accordion-body text-center">
                no tenemos datos para mostrar, en el informe de asistencias
              </div>
            </div> --}}
          @endif
          @if (!$noAsistentes->isEmpty())
          <div class="accordion-item">
            <h1 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                Informe de estudiantes que no asistieron
              </button>
            </h1>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table align-middle table-striped table-hover table-sm">
                  <thead>
                    <tr>
                      <th>Fecha ceremonia</th>
                      <th>Estudiantes citados</th>
                      <th>Estudiantes no asistentes</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($noAsistentes as $item)
                      <tr>
                        <td data-label="Fecha ceremonia">{{ $item->FECHA }}</td>
                        <td data-label="Estudiantes citados">{{ $item->estudiantes_citados }}</td>
                        <td data-label="Estudiantes asistentes">{{ $item->no_asistentes }}</td>
                      </tr>
                    @empty
                      <tr></tr>
                    @endforelse
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="5">
                        <a class="btn btn-cun sombra" href="{{route('noAssistance')}}">
                          <i class="bi bi-printer-fill"> {{__('Print')}}Informe NO asistentes</i>
                        </a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          @else
            {{-- <div class="accordion-item mt-2">
              <div class="accordion-header text-center">
                Informe de estudiantes que no asistieron
              </div>
              <div class="accordion-body text-center">
                no tenemos datos para mostrar, en el informe de asistencias
              </div>
            </div> --}}
          @endif
        </div>
        {{-- fin acordion --}}
      </div>
    </div>
  </div>
</x-app-layout>
