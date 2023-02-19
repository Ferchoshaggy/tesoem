<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materia_convalidacion');
            $table->unsignedBigInteger('id_proceso_alumno');
            $table->string("grupo")->nullable();
            $table->date("fecha");
            $table->foreign("id_materia_convalidacion")->references("id")->on("materias_convalidacion")->onDelete("cascade");
            $table->foreign("id_proceso_alumno")->references("id")->on("procesos_alumno")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_alumnos');
    }
}
