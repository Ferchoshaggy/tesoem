<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordarValidacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordar_validaciones', function (Blueprint $table) {
            $table->id();
            $table->string("union_claves");
            $table->bigInteger("id_materia_old");
            $table->bigInteger("id_materia_new");
            $table->integer("porcentaje_r");
            $table->date("fecha");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recordar_validaciones');
    }
}
