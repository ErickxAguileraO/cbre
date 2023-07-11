<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToMantencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mantencions', function (Blueprint $table) {
            $table->unsignedBigInteger('man_edificio_id')->after('man_listado_mantencions_id');

            $table->foreign('man_edificio_id')->references('edi_id')->on('edificios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mantencions', function (Blueprint $table) {
            $table->dropForeign(['man_edificio_id']);
            $table->dropColumn('man_edificio_id');
        });
    }
}
