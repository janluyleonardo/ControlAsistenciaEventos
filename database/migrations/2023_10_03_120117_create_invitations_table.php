<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('invitations', function (Blueprint $table) {
      $table->id();
      $table->string('ESCUELA');
      $table->string('NOMBRES');
      $table->string('DOCUMENTO')->unique();
      $table->string('CARRERA_TITULO');
      $table->string('TIPO_DOCUMENTO');
      $table->string('FECHA');
      $table->string('HORA');
      $table->string('CICLO');
      $table->string('CEREMONIA');
      $table->string('CORREO');
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
    Schema::dropIfExists('invitations');
  }
}
