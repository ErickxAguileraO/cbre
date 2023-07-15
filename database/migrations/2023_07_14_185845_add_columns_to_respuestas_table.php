<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respuestas', function (Blueprint $table) {
            $table->text('res_parrafo')->nullable()->after('res_comentario');
            $table->string('res_mes')->nullable()->after('res_comentario');
            $table->string('res_ano')->nullable()->after('res_comentario');
            $table->string('res_dotacion')->nullable()->after('res_comentario');
            $table->string('res_documento_accidentabilidad')->nullable()->after('res_comentario');
            $table->string('res_dotacion_sub_contratos')->nullable()->after('res_comentario');
            $table->string('res_dotacion_nuevos')->nullable()->after('res_comentario');
            $table->boolean('res_documentacion_sub_contrato')->default(0)->nullable()->after('res_comentario');
            $table->string('res_documentacion')->nullable()->after('res_comentario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respuestas', function (Blueprint $table) {
            $table->dropColumn('res_parrafo');
            $table->dropColumn('res_mes');
            $table->dropColumn('res_ano');
            $table->dropColumn('res_dotacion');
            $table->dropColumn('res_documento_accidentabilidad');
            $table->dropColumn('res_dotacion_sub_contratos');
            $table->dropColumn('res_dotacion_nuevos');
            $table->dropColumn('res_documentacion_sub_contrato');
            $table->dropColumn('res_documentacion');
        });
    }
}
