<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AgregarRolesYPermisosDelSistema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'index noticias']);
        Permission::create(['name' => 'index edificios']);
        Permission::create(['name' => 'index certificaciones']);
        Permission::create(['name' => 'index caracteristicas']);
        Permission::create(['name' => 'index submercados']);
        Permission::create(['name' => 'index comercios']);
        Permission::create(['name' => 'index indicadores']);
        Permission::create(['name' => 'index quienes somos']);
        Permission::create(['name' => 'index datos generales']);
        Permission::create(['name' => 'index administradores']);
        Permission::create(['name' => 'index funcionarios']);
        Permission::create(['name' => 'index contactos']);

        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo(Permission::all());

        $funcionarioRole = Role::create(['name' => 'funcionario']);
        $funcionarioRole->givePermissionTo('index noticias', 'index edificios');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::where('name', 'index noticias')->delete();
        Permission::where('name', 'index edificios')->delete();
        Permission::where('name', 'index certificaciones')->delete();
        Permission::where('name', 'index caracteristicas')->delete();
        Permission::where('name', 'index submercados')->delete();
        Permission::where('name', 'index comercios')->delete();
        Permission::where('name', 'index indicadores')->delete();
        Permission::where('name', 'index quienes somos')->delete();
        Permission::where('name', 'index datos generales')->delete();
        Permission::where('name', 'index administradores')->delete();
        Permission::where('name', 'index funcionarios')->delete();
        Permission::where('name', 'index contactos')->delete();

        Role::where('name', 'super-admin')->delete();
        Role::where('name', 'funcionario')->delete();
    }
}
