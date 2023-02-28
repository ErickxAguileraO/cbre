<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotFechaAndNotDestacadaFieldToNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dateTime('not_fecha')->useCurrent()->after('not_texto');
            $table->boolean('not_destacada')->default(false)->after('not_texto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropColumn('not_fecha');
            $table->dropColumn('not_destacada');
        });
    }
}
