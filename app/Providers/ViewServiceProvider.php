<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Views\Composers\EdificioComposer;
use App\Views\Composers\CaracteristicaComposer;
use App\Views\Composers\CertificacionComposer;
use App\Views\Composers\SubmercadoComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'admin.noticias.create',
            'admin.noticias.edit',
            'admin.comercios.create',
            'admin.comercios.edit',
            'admin.funcionarios.create',
            'admin.funcionarios.edit',
        ], EdificioComposer::class);

        View::composer([
            'web.edificios.index',
            'web.home',
        ], EdificioComposer::class . '@orderByName');

        View::composer([
            'admin.edificios.create',
            'admin.edificios.edit',
        ], CaracteristicaComposer::class);

        View::composer([
            'admin.edificios.create',
            'admin.edificios.edit',
        ], CertificacionComposer::class);

        View::composer([
            'admin.edificios.create',
            'admin.edificios.edit',
        ], SubmercadoComposer::class);
    }
}
