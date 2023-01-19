<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_medico', function (Blueprint $table) {
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
        Schema::dropIfExists('certificado_medico');
    }
}
