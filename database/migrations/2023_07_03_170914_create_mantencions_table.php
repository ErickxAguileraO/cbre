<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantencions', function (Blueprint $table) {
            $table->id('man_id');

            $table->unsignedBigInteger('man_listado_mantencions_id');
            $table->foreign('man_listado_mantencions_id')->references('lism_id')->on('listado_mantencions');

            $table->text('man_descripcion');
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
        Schema::dropIfExists('mantencions');
    }
}
