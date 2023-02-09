<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalesComercialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales_comerciales', function (Blueprint $table) {
            $table->id('loc_id');
            $table->string('loc_imagen');
            $table->text('loc_descripcion');
            $table->unsignedBigInteger('loc_edificio_id');
            $table->foreign('loc_edificio_id')->references('edi_id')->on('edificios');
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
        Schema::dropIfExists('locales_comerciales');
    }
}
