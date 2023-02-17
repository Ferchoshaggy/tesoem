<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_institucion');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string("nombre");
            $table->date("fecha");
            $table->string("clave");
            $table->string("horario")->nullable();
            $table->foreign("id_institucion")->references("id")->on("instituciones")->onDelete("cascade");
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
        Schema::dropIfExists('carreras');
    }
}
