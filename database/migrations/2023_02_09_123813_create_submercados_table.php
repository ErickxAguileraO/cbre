<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmercadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submercados', function (Blueprint $table) {
            $table->id('sub_id');
            $table->boolean('sub_estado');
            $table->string('sub_nombre');
            $table->unsignedBigInteger('sub_comuna_id');
            $table->foreign('sub_comuna_id')->references('com_id')->on('comunas');
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
        Schema::dropIfExists('submercados');
    }
}
