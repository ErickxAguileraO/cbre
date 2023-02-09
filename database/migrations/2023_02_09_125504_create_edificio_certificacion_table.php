<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdificioCertificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edificio_certificacion', function (Blueprint $table) {
            $table->id('edce_id');

            $table->unsignedBigInteger('edce_edificio_id');
            $table->foreign('edce_edificio_id')->references('edi_id')->on('edificios');

            $table->unsignedBigInteger('edce_certificacion_id');
            $table->foreign('edce_certificacion_id')->references('cer_id')->on('certificaciones');

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
        Schema::dropIfExists('edificio_certificacion');
    }
}
