<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id('obs_id');
            $table->text('obs_descripcion');
            $table->unsignedBigInteger('obs_formulario_edificio_id');
            $table->foreign('obs_formulario_edificio_id')->references('foredi_id')->on('formulario_edificio');

            $table->integer('obs_estado');
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
        Schema::dropIfExists('observaciones');
    }
}
