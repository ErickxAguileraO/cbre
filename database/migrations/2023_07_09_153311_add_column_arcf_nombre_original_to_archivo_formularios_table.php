<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnArcfNombreOriginalToArchivoFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archivo_formularios', function (Blueprint $table) {
            $table->string('arcf_nombre_original');
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
            $table->dropColumn('arcf_nombre_original');
        });
    }
}
