<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDagEmailEncargadoFieldToDatosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datos_generales', function (Blueprint $table) {
            $table->string('dag_email_encargado')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datos_generales', function (Blueprint $table) {
            $table->dropColumn('dag_email_encargado');
        });
    }
}
