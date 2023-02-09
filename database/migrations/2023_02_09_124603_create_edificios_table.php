<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdificiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edificios', function (Blueprint $table) {
            $table->id('edi_id');
            $table->string('edi_nombre');
            $table->text('edi_descripcion');
            $table->string('edi_direccion');
            $table->string('edi_imagen');
            $table->unsignedBigInteger('edi_submercado_id');
            $table->foreign('edi_submercado_id')->references('sub_id')->on('submercados');

            $table->string('ubi_titulo');
            $table->text('ubi_descripcion');
            $table->text('ubi_coordenadas');

            $table->softDeletes();

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
        Schema::dropIfExists('edificios');
    }
}
