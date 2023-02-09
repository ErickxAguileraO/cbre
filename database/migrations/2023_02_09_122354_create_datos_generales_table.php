<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_generales', function (Blueprint $table) {
            $table->id('dag_id');
            $table->string('dag_direccion')->nullable();
            $table->string('dag_telefono_uno')->nullable();
            $table->string('dag_telefono_dos')->nullable();
            $table->string('dag_facebook')->nullable();
            $table->string('dag_linkedin')->nullable();
            $table->string('dag_instagram')->nullable();
            $table->string('dag_twitter')->nullable();
            $table->string('dag_youtube')->nullable();
            $table->unsignedBigInteger('dag_comuna_id');
            $table->foreign('dag_comuna_id')->references('com_id')->on('comunas');
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
        Schema::dropIfExists('datos_generales');
    }
}
