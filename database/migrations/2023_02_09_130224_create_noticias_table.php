<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id('not_id');
            $table->string('not_imagen');
            $table->string('not_titulo');
            $table->text('not_texto');
            $table->unsignedBigInteger('not_edificio_id')->nullable();
            $table->foreign('not_edificio_id')->references('edi_id')->on('edificios');
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
        Schema::dropIfExists('noticias');
    }
}
