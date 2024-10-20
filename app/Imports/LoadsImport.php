<?php

namespace App\Imports;

use App\Models\mail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoadsImport implements ToModel, WithHeadingRow
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    return new mail([
      'ESCUELA' => $row['escuela'],
      'NOMBRES' => $row['nombres'],
      'CODIGO_UNICO' => $row['codigo_unico'],
      'CARRERA_TITULO' => $row['carrera_titulo'],
      'ACTA' => $row['acta'],
      'REGISTRO' => $row['registro'],
      'FOLIO' => $row['folio'],
      'LIBRO' => $row['libro'],
      'SNIES' => $row['snies'],
      'DIA_TEXTO' => $row['dia_texto'],
      'DIA_NUMERO' => $row['dia_numero'],
      'MES_TEXTO' => $row['mes_texto'],
      'AÑO_NUMERO' => $row['ano_numero'],
      'FECHA_GRADO' => $row['fecha_grado'],
      'DADO_EN' => $row['dado_en'],
      'GENERO' => $row['genero'],
      'AÑO_TEXTO' => $row['ano_texto'],
      'TIPO_DOCUMENTO' => $row['tipo_documento'],
      'OBSERVACIONES' => $row['observaciones'],
      'DONDE_RECIBE' => $row['donde_recibe'],
      'FECHA' => $row['fecha'],
      'HORA' => $row['hora'],
      'CICLO' => $row['ciclo'],
      'CEREMONIA' => $row['ceremonia'],
      'CORREO' => $row['correo'],
      'LUGAR' => $row['lugar'],
      'PROGRAMA' => $row['programa'],
      'CICLO_NUMERO' => $row['ciclo_numero'],
      'PROMEDIO' => $row['promedio'],
      'SILLA' => $row['silla'],
      // 'ENVIO_CORREO_INVITACION' => $row['envio_correo_invitacion'],
      // 'ASISTENCIA_CEREMONIA' => $row['asistencia_ceremonia'],
      // 'SCAN_QR' => $row['scan_qr'],
    ]);
  }
}
