<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ape_pat')->nullable();
            $table->string('ape_mat')->nullable();
            $table->integer('edad')->nullable();
            $table->text('direccion')->nullable();
            $table->string('email')->unique();
            $table->string("foto")->nullable();
            $table->string('matricula')->unique();
            $table->integer('m_tesoem')->nullable();
            $table->integer('carrera_tesoem');
            $table->bigInteger('id_proceso_activo')->nullable();
            $table->unsignedBigInteger('tipo_user');
            $table->foreign("tipo_user")->references("id")->on("tabla_roles")->onDelete("cascade");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
