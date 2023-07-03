<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_preguntas', function (Blueprint $table) {
            $table->id('tipp_id');
            $table->string('tipp_nombre');
            $table->timestamps();
        });

        $this->run();
    }

    private function run()
    {
        $tipoPreguntas = [
            ['tipp_nombre' => 'Selección individual', 'created_at' => now(), 'updated_at' => now()],
            ['tipp_nombre' => 'Selección múltiple', 'created_at' => now(), 'updated_at' => now()],
            ['tipp_nombre' => 'Párrafo', 'created_at' => now(), 'updated_at' => now()],
            ['tipp_nombre' => 'HSE - Accidentabilidad', 'created_at' => now(), 'updated_at' => now()]
        ];

        DB::transaction(function () use ($tipoPreguntas) {
            DB::table('tipo_preguntas')->insert($tipoPreguntas);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_preguntas');
    }
}
