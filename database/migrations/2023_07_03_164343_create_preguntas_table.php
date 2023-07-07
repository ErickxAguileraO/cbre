<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id('pre_id');

            $table->unsignedBigInteger('pre_formulario_id');
            $table->foreign('pre_formulario_id')->references('form_id')->on('formularios');

            $table->unsignedBigInteger('pre_tipo_pregunta_id');
            $table->foreign('pre_tipo_pregunta_id')->references('tipp_id')->on('tipo_preguntas');

            $table->string('pre_pregunta');
            $table->boolean('pre_obligatorio')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('preguntas');
    }
}
