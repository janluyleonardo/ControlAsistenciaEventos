<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
  use HasFactory;

  protected $fillable = [
    'ESCUELA',
    'NOMBRES',
    'DOCUMENTO',
    'CARRERA_TITULO',
    'TIPO_DOCUMENTO',
    'FECHA',
    'HORA',
    'CICLO',
    'CEREMONIA',
    'CORREO',
  ];
}
