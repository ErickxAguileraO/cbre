<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdificioCaracteristicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edificio_caracteristica', function (Blueprint $table) {
            $table->id('edca_id');

            $table->unsignedBigInteger('edca_edificio_id');
            $table->foreign('edca_edificio_id')->references('edi_id')->on('edificios');

            $table->unsignedBigInteger('edca_caracteristica_id');
            $table->foreign('edca_caracteristica_id')->references('car_id')->on('caracteristicas');

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
        Schema::dropIfExists('edificio_caracteristica');
    }
}
