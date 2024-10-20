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
        <td>{{ $item->Fecha_Ceremonia }}</td>
        <td>{{ $item->Hora_Ceremonia }}</td>
        <td>{{ $item->Total_Citados }}</td>
        <td>{{ $item->sum_Asistentes }}</td>
        <td>{{ $item->Total_Citados - $item->sum_Asistentes }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
