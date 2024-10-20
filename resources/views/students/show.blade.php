<x-students-layout>

    <div class="abslute flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-0 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-1 lg:px-1">
            <div class="flex justify-center titulo-welcome">
                {{ env('APP_NAME', 'Asistencia - grados') }}
            </div>
            <div class="container">
                <div class="card bg-light mt-3 mb-3">
                    <div class="card-header text-center">
                        Listado de invitaciones disponibles para que las descargues y las presentes el dia de
                        tu ceremonia.
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <table class="table align-middle table-striped table-hover table-sm mt-3">
                                <thead>
                                    <tr>
                                        <th>Nombre estudiante</th>
                                        <th>Correo electrónico</th>
                                        <th>Número documento</th>
                                        <th>Nombre producto</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label="Nombre">{{ $studentCertificates->NOMBRES }}</td>
                                        <td data-label="Correo">{{ $studentCertificates->CORREO }}</td>
                                        <td data-label="Documento">{{ $studentCertificates->CODIGO_UNICO }}</td>
                                        <td data-label="Producto">Invitación graduando</td>
                                        <td>
                                          <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="sombra btn btn-cun" href="{{ route('printPDF', $studentCertificates->id) }}" onclick="mostrar()"><i class="bi bi-file-earmark-pdf"></i></a>
                                          </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-students-layout>
