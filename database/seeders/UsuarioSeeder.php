<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idUsuario = DB::table('users')->insertGetId([
            'name' => 'Super',
            'email' => 'admin@cbre.cl',
            'password' => Hash::make('12345678'),
            'email_verified_at' => '2023-02-19 21:59:22'
        ]);

        DB::table('administradores')->insert([
            'adm_nombre' => 'Taylor',
            'adm_apellido' => 'Otwell',
            'adm_user_id' => $idUsuario
        ]);
    }
}
