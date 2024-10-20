<?php

namespace Database\Factories;

use App\Models\Download;
use Illuminate\Database\Eloquent\Factories\Factory;

class DownloadFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */

  protected $model = Download::class;

  public function definition()
  {
    return [
      'student_name' => $this->faker->name(),
      'participant_type' => $this->faker->randomElement(['Estudiante', 'Egresado', 'Externo']),
      'email' => $this->faker->safeEmail(),
      'document_type' => $this->faker->randomElement(['CC', 'CE', 'TI', 'PA', 'RC']),
      'document_number' => $this->faker->unique()->ean8(),
      'product_name' => $this->faker->randomElement(['Curso de programacion', 'Curso de manejo de emociones', 'Curso de empleabilidad', 'Curso de diseño de HV', 'Curso de costura']),
      'date_realized' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
      'duration' => $this->faker->numberBetween($min = 30, $max = 100),
      'modality' => $this->faker->randomElement(['Virtual', 'Presencial']),
      'city_expedition' => "Bogotá",
      'download_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
    ];
  }
}
