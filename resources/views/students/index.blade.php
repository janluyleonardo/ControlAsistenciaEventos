<x-students-layout>

  <div class="container">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
          <div class="max-w-6xl mx-auto sm:px-1 lg:px-1">
            <div class="flex text-center titulo-welcome">
              {{ config('app.name', 'Asistencia - grados') }}<br>
              Consulta tus invitaciones.
            </div>
            <div class="flex justify-center sm:justify-center sm:pt-0">
              <img class="sombra-inter-negro" src="{{ asset('images/logo-welcome.png') }}" alt="logo-cun" width="250">
            </div>
            <div class="d-flex justify-content-center">
              <form method="post" action="{{route('consult.store')}}">
                @csrf
                <select class="form-control select-buscar" id="Tipo_documento" name="Tipo_documento" required autofocus>
                  <option value="" hidden selected>Selecciona tipo de servicio</option>
                  @foreach($documentsList as $document)
                    <option value="{{ $document->codigo }}">{{ $document->valor }}</option>
                  @endforeach
                </select>
                <div class="flex items-center justify-center mt-2">
                  <input type="number]]" class="form-control text-buscar" placeholder="Número de documento" name="documento" id="documento" required >
                </div>
                <div class="flex items-center justify-center mt-2">
                  <input type="email" class="form-control text-buscar" placeholder="Correo electrónico" name="correo" id="correo" required>
                </div>
                <div class="flex items-center justify-center mt-1">
                  <label for="remember_me" class="justify-end">
                    <x-jet-checkbox id="remember_me" name="remember" required />
                    <span class="ml-2 text-sm text-gray-600">
                      <a style="color:#00792C;" href="https://repo.cunapp.dev/web/2020/06/Politica-de-manejo-y-proteccion-de-la-informacion.pdf" target="_blank">
                        {{ __('Term&cond') }}</a>
                    </span>
                  </label>
                </div>
                <input type="submit" class="sombra btn btn-secondary btn-buscar" value="{{__('Check')}}">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-students-layout>
