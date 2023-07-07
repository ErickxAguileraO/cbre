<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivoMantencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivo_mantencions', function (Blueprint $table) {
            $table->id('arcm_id');

            $table->unsignedBigInteger('arcm_mantencion_id');
            $table->foreign('arcm_mantencion_id')->references('man_id')->on('mantencions');

            $table->string('arcm_url');
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
        Schema::dropIfExists('archivo_mantencions');
    }
}
