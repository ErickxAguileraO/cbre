<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivoFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivo_formularios', function (Blueprint $table) {
            $table->id('arcf_id');

            $table->unsignedBigInteger('arcf_pregunta_id');
            $table->foreign('arcf_pregunta_id')->references('pre_id')->on('preguntas');

            $table->unsignedBigInteger('arcf_respuesta_id');
            $table->foreign('arcf_respuesta_id')->references('res_id')->on('respuestas');

            $table->string('arcf_url');
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
        Schema::dropIfExists('archivo_formularios');
    }
}
