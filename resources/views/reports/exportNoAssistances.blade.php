<table class="table align-middle table-striped table-hover table-sm">
  <thead>
    <tr>
      <th>Fecha ceremonia</th>
      <th>Estudiantes citados</th>
      <th>Estudiantes no asistentes</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($informeNoAsistencias as $item)
      <tr>
        <td data-label="Fecha ceremonia">{{ $item->FECHA }}</td>
        <td data-label="Estudiantes citados">{{ $item->estudiantes_citados }}</td>
        <td data-label="Estudiantes asistentes">{{ $item->no_asistentes }}</td>
      </tr>
    @empty
      <tr></tr>
    @endforelse
  </tbody>
</table>
