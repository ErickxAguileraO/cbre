<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'index area tecnica']);
        Permission::create(['name' => 'index mantencion']);
        Permission::create(['name' => 'index formulario']);

        $prevencionistaRole = Role::create(['name' => 'prevencionista']);
        $prevencionistaRole->givePermissionTo('index area tecnica');

        $tecnicoRole = Role::create(['name' => 'tecnico']);
        $tecnicoRole->givePermissionTo('index area tecnica', 'index mantencion');

        Role::where('name', 'super-admin')->first()->givePermissionTo('index area tecnica', 'index mantencion', 'index formulario');
        Role::where('name', 'funcionario')->first()->givePermissionTo('index mantencion', 'index formulario');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::where('name', 'index area tecnica')->delete();
        Permission::where('name', 'index mantencion')->delete();
        Permission::where('name', 'index formulario')->delete();

        Role::where('name', 'prevencionista')->delete();
        Role::where('name', 'tecnico')->delete();
    }
}
