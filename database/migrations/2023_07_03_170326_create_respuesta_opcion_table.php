<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestaOpcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta_opcion', function (Blueprint $table) {
            $table->id('reop_id');

            $table->unsignedBigInteger('reop_respuesta_id');
            $table->foreign('reop_respuesta_id')->references('res_id')->on('respuestas');

            $table->unsignedBigInteger('reop_opcion_id');
            $table->foreign('reop_opcion_id')->references('opc_id')->on('opcions');

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
        Schema::dropIfExists('respuesta_opcion');
    }
}
