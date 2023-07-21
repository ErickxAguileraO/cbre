<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historials', function (Blueprint $table) {
            $table->string('his_accion')->nullable()->after('his_formulario_edificio_id');
            $table->string('his_usuario')->nullable()->after('his_accion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historials', function (Blueprint $table) {
            $table->dropColumn('his_accion');
            $table->dropColumn('his_usuario');
        });
    }
}
