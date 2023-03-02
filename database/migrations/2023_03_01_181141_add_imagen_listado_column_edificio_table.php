<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenListadoColumnEdificioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edificios', function (Blueprint $table) {
            $table->string('edi_imagen_listado')->after('edi_imagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('edificios', function (Blueprint $table) {
            $table->dropColumn('edi_imagen_listado');
        });
    }
}
