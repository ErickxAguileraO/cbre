<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFunEdificioId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->unsignedBigInteger('fun_edificio_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->unsignedBigInteger('fun_edificio_id')->change();
        });
    }
}
