<?php

namespace Database\Seeders;

use App\Models\DatoGeneral;
use App\Models\Indicador;
use App\Models\QuienesSomos;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        QuienesSomos::create();
        DatoGeneral::create([
            'dag_comuna_id' => 96,
        ]
        );
        Indicador::create();
        $this->call(UsuarioSeeder::class);
    }
}
