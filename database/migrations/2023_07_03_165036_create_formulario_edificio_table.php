<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormularioEdificioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulario_edificio', function (Blueprint $table) {
            $table->id('foredi_id');

            $table->unsignedBigInteger('foredi_formulario_id');
            $table->foreign('foredi_formulario_id')->references('form_id')->on('formularios');

            $table->unsignedBigInteger('foredi_edificio_id');
            $table->foreign('foredi_edificio_id')->references('edi_id')->on('edificios');

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
        Schema::dropIfExists('formulario_edificio');
    }
}
