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
            $table->unsignedBigInteger('id_user');
            $table->string("ruta");
            $table->date("fecha");
            $table->text("descripcion")->nullable();
            $table->string("aprobacion")->nullable();
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
        Schema::dropIfExists('comprobante_pago');
    }
}
