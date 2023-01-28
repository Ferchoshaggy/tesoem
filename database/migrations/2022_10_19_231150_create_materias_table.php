<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_institucion');
            $table->unsignedBigInteger('id_carrera');
            //$table->unsignedBigInteger('id_semestre');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->integer("semestre");
            $table->string("nombre");
            $table->string("matricula");
            $table->text("temario");
            $table->string("creditos")->nullable();
            $table->date("fecha");
            $table->foreign("id_institucion")->references("id")->on("instituciones")->onDelete("cascade");
            $table->foreign("id_carrera")->references("id")->on("carreras")->onDelete("cascade");
            //$table->foreign("id_semestre")->references("id")->on("semestres")->onDelete("cascade");
            $table->foreign("id_user")->references("id")->on("users")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
