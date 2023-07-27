<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeidaToMantencions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mantencions', function (Blueprint $table) {
            $table->boolean('man_leida')->default(false)->nullable()->after('man_descripcion');
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
            $table->dropColumn('man_leida');
        });
    }
}
