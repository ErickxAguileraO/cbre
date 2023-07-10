<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ ListadoMantencion;

class InsertDatosIntoListadoMantenciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ListadoMantencion::insert([
            [
                'lism_nombre' => 'Sistema Electricidad',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Sistema Climatización',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Sistema Ventilación (VIN/VEX)',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Sistema Ascensores',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Grupo Electrógeno',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Sistema Hidráulico',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Detección de Incendios/CO2 y Audioevacuación',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Extinción de Incendio',
                'lism_estado' => '1',
            ],
            [
                'lism_nombre' => 'Sistema Circuito Cerrado de Televisión (CCTV)',
                'lism_estado' => '1',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ListadoMantencion::query()->delete();
    }
}
