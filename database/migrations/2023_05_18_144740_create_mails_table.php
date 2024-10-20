<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatemailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mails', function (Blueprint $table) {
      $table->id();
      $table->string('ESCUELA');
      $table->string('NOMBRES');
      $table->string('CODIGO_UNICO');
      $table->string('CARRERA_TITULO');
      $table->string('ACTA');
      $table->string('REGISTRO');
      $table->string('FOLIO');
      $table->string('LIBRO');
      $table->string('SNIES');
      $table->string('DIA_TEXTO');
      $table->string('DIA_NUMERO');
      $table->string('MES_TEXTO');
      $table->string('AÑO_NUMERO');
      $table->string('FECHA_GRADO');
      $table->string('DADO_EN');
      $table->string('GENERO');
      $table->string('AÑO_TEXTO');
      $table->string('TIPO_DOCUMENTO');
      $table->string('OBSERVACIONES')->nullable();
      $table->string('DONDE_RECIBE');
      $table->date('FECHA');
      $table->string('HORA');
      $table->string('CICLO');
      $table->string('CEREMONIA');
      $table->string('CORREO')->nullable();
      $table->string('LUGAR');
      $table->string('PROGRAMA');
      $table->string('CICLO_NUMERO');
      $table->string('PROMEDIO')->nullable();
      $table->string('SILLA')->nullable();
      $table->string('ENVIO_CORREO_INVITACION')->nullable();
      $table->string('ASISTENCIA_CEREMONIA')->nullable();
      $table->string('SCAN_QR')->default('FALSE');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('mails');
  }
}
