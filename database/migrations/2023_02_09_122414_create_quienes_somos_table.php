<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuienesSomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quienes_somos', function (Blueprint $table) {
            $table->id('qus_id');
            $table->string('qus_titulo')->nullable();
            $table->text('qus_texto')->nullable();
            $table->string('qus_imagen')->nullable();
            $table->timestamps();
        });

        $this->run();
    }

    private function run()
    {
        $quienesSomos = [
            ['qus_titulo' => null, 'qus_texto' => null, 'qus_imagen' => null, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::transaction(function () use ($quienesSomos) {
            DB::table('quienes_somos')->insert($quienesSomos);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quienes_somos');
    }
}
