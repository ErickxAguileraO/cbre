<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateArchivoFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archivo_formularios', function (Blueprint $table) {
            $table->unsignedBigInteger('arcf_pregunta_id')->nullable()->change();
            $table->unsignedBigInteger('arcf_respuesta_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archivo_formularios', function (Blueprint $table) {
            $table->unsignedBigInteger('arcf_pregunta_id')->change();
            $table->unsignedBigInteger('arcf_respuesta_id')->change();
        });
    }
}
