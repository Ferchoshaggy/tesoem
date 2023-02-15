<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasConvalidacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_convalidacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materia');
            $table->unsignedBigInteger('id_user');
            $table->integer("calificacion")->nullable();
            $table->date("fecha");
            $table->integer("porcentaje")->nullable();
            $table->string("validacion")->nullable();
            $table->foreign("id_materia")->references("id")->on("materias")->onDelete("cascade");
            $table->foreign("id_user")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias_convalidacion');
    }
}
