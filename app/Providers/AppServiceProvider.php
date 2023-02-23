<?php

namespace App\Providers;

use App\Models\DatoGeneral;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($datosRespuesta = null, $codigoHttp = 200) {
            return response()->json([
                'status' => 'success',
                'data' => $datosRespuesta
            ], $codigoHttp);
        });

        Response::macro('fail', function ($datosRespuesta, $codigoHttp = 400) {
            return response()->json([
                'status' => 'fail',
                'data' => $datosRespuesta
            ], $codigoHttp);
        });

        Response::macro('error', function ($mensaje, $datos, $codigoHttp = 500) {
            return response()->json([
                'status' => 'error',
                'message' => $mensaje,
                'data' => $datos
            ], $codigoHttp);
        });

        view()->composer(
            ['layout.web'],
            function ($view) {
                $view->with([
                    'datos_generales' => DatoGeneral::first(),
                ]
            );
            }
        );
    }
}
