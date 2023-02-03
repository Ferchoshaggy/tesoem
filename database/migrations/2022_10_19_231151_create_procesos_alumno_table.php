<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesosAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos_alumno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_user");
            $table->unsignedBigInteger('id_institucion_old')->nullable();
            $table->unsignedBigInteger('id_carrera_old')->nullable();
            $table->integer("semestre")->nullable();
            $table->date("fecha");
            $table->integer("estatus");
            $table->integer("etapa");
            $table->integer("tipo_proceso");
            $table->foreign("id_user")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("id_institucion_old")->references("id")->on("instituciones")->onDelete("set null");
            $table->foreign("id_carrera_old")->references("id")->on("carreras")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procesos_alumno');
    }
}
