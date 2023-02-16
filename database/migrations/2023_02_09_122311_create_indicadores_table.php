<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id('ind_id');
            $table->integer('ind_administrados')->nullable();
            $table->integer('ind_confia_en_nosotros')->nullable();
            $table->integer('ind_en_todo_chile')->nullable();
            $table->integer('ind_en_todo_chile2')->nullable();
            $table->timestamps();
        });

        $this->run();
    }

    private function run()
    {
        $indicadores = [
            ['ind_administrados' => null, 'ind_confia_en_nosotros' => null, 'ind_en_todo_chile' => null, 'ind_en_todo_chile2' => null, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::transaction(function () use ($indicadores) {
            DB::table('indicadores')->insert($indicadores);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicadores');
    }
}
