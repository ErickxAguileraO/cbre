<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Views\Composers\EdificioComposer;

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
        ], EdificioComposer::class);
    }
}
