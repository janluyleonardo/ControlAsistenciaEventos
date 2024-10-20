<x-students-layout>

  <div class="container">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6 ">
        <div class="flex justify-center sm:justify-center sm:pt-0">
          <img class="sombra-inter-negro" src="{{ asset('images/logo-welcome.png') }}" alt="logo-cun" width="200">
        </div>
        <div class="col-md-10 m-auto">
          <form action="{{route('asistencia')}}" method="POST">
            @csrf
                <div class="flex items-center justify-center mt-2">
                  <input type="text" class="form-control text-buscar" value="{{$name}}" name="name" id="name" readonly >
                </div>
                <div class="flex items-center justify-center mt-2">
                  <input type="text" class="form-control text-buscar" value="{{$document}}" name="document" id="document" readonly>
                </div>
                <div class="flex items-center justify-center mt-2">
                  <input type="email" class="form-control text-buscar" value="{{$correo}}" name="correo" id="correo" readonly>
                </div>
                <div class="flex items-center justify-center mt-2">
                  <input type="date" class="form-control text-buscar m-auto" value="{{$fecha}}" name="fecha" id="fecha" readonly>
                  <input type="text" class="form-control text-buscar m-auto" value="{{$hora}}" name="hora" id="hora" readonly>
                </div>
                <div class="flex items-center justify-center mt-1">
                  <label for="graduando" class="justify-end">
                    <x-jet-checkbox id="graduando" name="graduando" required />
                    <span class="ml-2 text-lg text-gray-600">
                      Graduando &nbsp;
                    </span>
                  </label>
                </div>
                <div class="flex items-center justify-center mt-1">
                  <label for="invitado_uno" class="justify-end">
                    <x-jet-checkbox id="invitado_uno" name="invitado_uno"/>
                    <span class="ml-2 text-lg text-gray-600">
                      Invitado uno
                    </span>
                  </label>
                </div>
                <div class="flex items-center justify-center mt-1">
                  <label for="invitado_dos" class="justify-end">
                    <x-jet-checkbox id="invitado_dos" name="invitado_dos"/>
                    <span class="ml-2 text-lg text-gray-600">
                      Invitado dos
                    </span>
                  </label>
                </div>
                <button type="submit" class="sombra btn btn-secondary btn-buscar" onclick="mostrar()">{{__('Save')}} asistencia</button>
              </form>
        </div>
      </div>
    </div>
  </div>

</x-students-layout>
