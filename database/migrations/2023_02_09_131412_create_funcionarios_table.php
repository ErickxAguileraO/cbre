<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id('fun_id');
            $table->string('fun_nombre');
            $table->string('fun_apellido');
            $table->bigInteger('fun_telefono');
            $table->string('fun_foto');
            $table->string('fun_cargo');
            $table->unsignedBigInteger('fun_user_id');
            $table->foreign('fun_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('funcionarios');
    }
}
