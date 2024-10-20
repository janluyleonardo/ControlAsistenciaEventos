<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_estudiante',
        'tipo_participante',
        'email',
        'tipo_documento',
        'numero_documento',
        'nombre_producto',
        'fecha_realización',
        'duración',
        'modalidad',
        'ciudad_expedición',
    ];
}
