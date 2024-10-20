<?php

namespace Database\Factories;

use App\Models\Load;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoadFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  protected $model = Load::class;

  // 'name' => $this->faker->name(),
  // 'email' => $this->faker->unique()->safeEmail(),
  // 'email_verified_at' => now(),
  // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
  // 'remember_token' => Str::random(10),

  public function definition()
  {
    return [
      'nombre_estudiante' => $this->faker->name(),
      'tipo_participante' => $this->faker->randomElement(['Estudiante', 'Egresado', 'Externo']),
      'email' => $this->faker->safeEmail(),
      'tipo_documento' => $this->faker->randomElement(['CC', 'CE', 'TI', 'PA', 'RC']),
      'numero_documento' => $this->faker->unique()->ean8(),
      'nombre_producto' => $this->faker->randomElement(['Curso de programacion', 'Curso de manejo de emociones', 'Curso de empleabilidad', 'Curso de diseño de HV', 'Curso de costura']),
      'fecha_realización' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
      'duración' => $this->faker->numberBetween($min = 30, $max = 100),
      'modalidad' => $this->faker->randomElement(['Virtual', 'Presencial']),
      'ciudad_expedición' => "Bogotá",

      'ESCUELA' => $this->faker->name(),
      'NOMBRES' => $this->faker->fullname(),
      'CODIGO_UNICO' => $this->faker->numberBetween($min = 3000, $max = 10000),
      'CARRERA_TITULO' => $this->faker->name(),
      'ACTA' => $this->faker->name(),
      'REGISTRO' => $this->faker->name(),
      'FOLIO' => $this->faker->name(),
      'LIBRO' => $this->faker->name(),
      'SNIES' => $this->faker->name(),
      'DIA_TEXTO' => $this->faker->name(),
      'DIA_NUMERO' => $this->faker->name(),
      'MES_TEXTO' => $this->faker->name(),
      'AÑO_NUMERO' => $this->faker->name(),
      'FECHA_GRADO' => $this->faker->name(),
      'DADO_EN' => $this->faker->name(),
      'GENERO' => $this->faker->name(),
      'AÑO_TEXTO' => $this->faker->name(),
      'TIPO_DOCUMENTO' => $this->faker->name(),
      'OBSERVACIONES' => $this->faker->name(),
      'DONDE_RECIBE' => $this->faker->name(),
      'FECHA' => $this->faker->name(),
      'HORA' => $this->faker->name(),
      'CICLO' => $this->faker->name(),
      'CEREMONIA' => $this->faker->name(),
      'CORREO' => $this->faker->name(),
    ];
  }
}
