<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_pdf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_carrera');
            $table->string("j_division");
            $table->integer("sexo_j_division");
            $table->string("p_academia");
            $table->integer("sexo_p_academia");
            $table->string("s_academia");
            $table->integer("sexo_s_academia");
            $table->string("j_control_escolar");
            $table->integer("sexo_j_control_escolar");
            $table->string("texto_superior");
            $table->date("fecha");
            $table->foreign("id_carrera")->references("id")->on("carreras")->onDelete("cascade");
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
        Schema::dropIfExists('datos_pdf');
    }
}
