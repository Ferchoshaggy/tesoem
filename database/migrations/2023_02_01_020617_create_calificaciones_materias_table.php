<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones_materias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materia');
            $table->unsignedBigInteger('id_proceso_alumno');
            $table->integer("calificacion")->nullable();
            $table->date("fecha");
            $table->bigInteger("id_materia_convalida")->nullable();
            $table->foreign("id_materia")->references("id")->on("materias")->onDelete("cascade");
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
        Schema::dropIfExists('calificaciones_materias');
    }
}
