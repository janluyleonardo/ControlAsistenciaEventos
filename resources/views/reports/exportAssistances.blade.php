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
    @foreach ($informeAsistencias as $item)
      <tr>
          <td>{{ $item->FECHA }}</td>
          <td>{{ $item->estudiantes_citados }}</td>
          <td>{{ $item->asistencia_con_invitados }}</td>
          <td>{{ $item->estudiantes_asistentes }}</td>
          <td>{{ $item->invitados_asistentes }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
