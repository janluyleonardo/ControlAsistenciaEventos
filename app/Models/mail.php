<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mail extends Model
{
  use HasFactory;

  protected $fillable = [
    'ESCUELA',
    'NOMBRES',
    'CODIGO_UNICO',
    'CARRERA_TITULO',
    'ACTA',
    'REGISTRO',
    'FOLIO',
    'LIBRO',
    'SNIES',
    'DIA_TEXTO',
    'DIA_NUMERO',
    'MES_TEXTO',
    'AÑO_NUMERO',
    'FECHA_GRADO',
    'DADO_EN',
    'GENERO',
    'AÑO_TEXTO',
    'TIPO_DOCUMENTO',
    'OBSERVACIONES',
    'DONDE_RECIBE',
    'FECHA',
    'HORA',
    'CICLO',
    'CEREMONIA',
    'CORREO',
    'LUGAR',
    'PROGRAMA',
    'CICLO_NUMERO',
    'PROMEDIO',
    'SILLA',
  ];
}
