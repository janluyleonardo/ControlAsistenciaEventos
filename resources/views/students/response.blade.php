<x-students-layout>
  @section('js')
    @if (session('response') == 'ok')
      <script>
        Swal.fire({
            title: "{{$title}}",
            html: "{{$text}} <br><br><strong><h3> {{$html}} </h3></strong>",
            icon: "{{$icon}}",
            confirmButtonColor: "#005eb8",
            confirmButtonText: "Salir",
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then((result) => {
            if (result.isConfirmed) {
              mostrar(),
              window.location.href = '{{ url()->previous() }}';
            }
          });
      </script>
    @endif
  @endsection
</x-students-layout>
