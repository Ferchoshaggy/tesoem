<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprobantePagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobante_pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proceso_alumno');
            $table->string("ruta");
            $table->date("fecha");
            $table->text("descripcion")->nullable();
            $table->integer("estatus")->nullable();
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
        Schema::dropIfExists('comprobante_pago');
    }
}
