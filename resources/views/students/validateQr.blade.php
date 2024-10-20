<x-students-layout>

  <div class="container">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
          <div class="max-w-6xl mx-auto sm:px-1 lg:px-1">
            <div class="flex justify-center titulo-welcome">
              {{ config('app.name', 'Asistencia - grados') }}
            </div>
            <div class="flex justify-center titulo-welcome">
              Validacion de certificado.
            </div>
            @if($certifiedValidate->isEmpty())
            <div class="justify-center" style="font-size:16px;">
              <p>
                Lamentablemente, el certificado escaneado ha sido detectado como
                <strong>adulterado</strong>. No podemos confirmar su autenticidad ni validez.
                <br>Agradecemos tu colaboración en reportar este incidente.
                <br>Si tienes dudas o necesitas asistencia, contáctanos en egresados@cun.edu.co.
                Equipo de Desarrollo Profesional y Egresados de la CUN.
              </p>
              </div>
            @else
            <div class="justify-center" style="font-size:16px;">
              <p>
                ¡Gracias por utilizar nuestro sistema de validación de certificados de la CUN!
                <br>Hemos verificado el certificado escaneado y
                <strong>confirmamos su autenticidad y validez</strong>.
                <br>Si tienes alguna pregunta o necesitas asistencia, contáctanos en
                egresados@cun.edu.co.
                <br>Agradecemos tu confianza en nuestros certificados.
                <br>¡Equipo de Desarrollo Profesional y Egresados de la CUN!
              </p>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

</x-students-layout>
