<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRegionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regiones', function (Blueprint $table) {
            $table->id('reg_id');
            $table->string('reg_nombre');
            $table->timestamps();
        });

        $this->run();
    }

    public const REGION_FIELDS = [
        'reg_nombre',
    ];

    public const REGIONES_DATA = [
        ['Tarapacá'],
        ['Antofagasta'],
        ['Atacama'],
        ['Coquimbo'],
        ['Valparaíso'],
        ["Libertador General Bernardo O'Higgins"],
        ['Maule'],
        ['Biobío'],
        ['La Araucanía'],
        ['Los Lagos'],
        ['Aysén del General Carlos Ibáñez del Campo'],
        ['Magallanes y de la Antártica Chilena'],
        ['Metropolitana de Santiago'],
        ['Los Ríos'],
        ['Arica y Parinacota'],
        ['Ñuble'],
    ];

    private function run()
    {
        $regiones = array_map(function (array $regionData) {
            return array_combine(self::REGION_FIELDS, $regionData);
        }, self::REGIONES_DATA);

        DB::transaction(function () use ($regiones) {
            DB::table('regiones')->insert($regiones);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regiones');
    }
}
