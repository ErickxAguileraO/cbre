<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLatitudAndLongitudAndOthers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edificios', function (Blueprint $table) {
            $table->dropColumn('ubi_coordenadas');
            $table->string('edi_subdominio')->after('ubi_descripcion');
            $table->string('edi_video')->nullable()->after('ubi_descripcion');
            $table->string('edi_longitud')->after('ubi_descripcion');
            $table->string('edi_latitud')->after('ubi_descripcion');
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
            $table->text('ubi_coordenadas');
            $table->dropColumn('edi_video');
            $table->dropColumn('edi_latitud');
            $table->dropColumn('edi_longitud');
            $table->dropColumn('edi_subdominio');
        });
    }
}
