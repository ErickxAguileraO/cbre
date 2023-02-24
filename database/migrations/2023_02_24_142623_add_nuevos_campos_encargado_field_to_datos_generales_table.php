<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNuevosCamposEncargadoFieldToDatosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datos_generales', function (Blueprint $table) {
            $table->string('dag_nombre_encargado')->nullable();
            $table->bigInteger('dag_telefono_encargado')->nullable();
            $table->string('dag_imagen_encargado')->nullable();
            $table->string('dag_cargo_encargado')->nullable();
        });

        $this->run();
    }

    private function run()
    {
        $datosGenerales = [
            ['dag_direccion' => null, 'dag_telefono_uno' => null, 'dag_telefono_dos' => null, 'dag_facebook' => null, 'dag_linkedin' => null,
            'dag_instagram' => null, 'dag_twitter' => null, 'dag_youtube' => null, 'dag_email_encargado' => null,
            'dag_nombre_encargado' => null, 'dag_telefono_encargado' => null,
            'dag_imagen_encargado' => null, 'dag_cargo_encargado' => null, 'dag_comuna_id' => 96,
            'created_at' => now(), 'updated_at' => now()
            ],
        ];

        DB::transaction(function () use ($datosGenerales) {
            DB::table('datos_generales')->insert($datosGenerales);
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
            $table->dropColumn('dag_nombre_encargado');
            $table->dropColumn('dag_telefono_encargado');
            $table->dropColumn('dag_imagen_encargado');
            $table->dropColumn('dag_cargo_encargado');
        });
    }
}
