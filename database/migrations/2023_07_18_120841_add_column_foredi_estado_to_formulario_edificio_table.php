<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForediEstadoToFormularioEdificioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulario_edificio', function (Blueprint $table) {
            $table->integer('foredi_estado')->default(4)->after('foredi_edificio_id');
            // estado 4 borrador
            // estado 1 publicado
            // estado 2 respondido
            // estado 3 cerrado
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulario_edificio', function (Blueprint $table) {
            $table->dropColumn('foredi_estado');
        });
    }
}
