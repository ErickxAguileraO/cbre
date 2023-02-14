<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\CaracteristicaController;
use App\Http\Controllers\Administracion\NoticiaController;
use App\Http\Controllers\Administracion\CertificacionController;
use App\Http\Controllers\Administracion\QuienesSomosController;
use App\Http\Controllers\Administracion\SubMercadoController;
use App\Http\Controllers\Administracion\ComunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Rutas para la administración
 */
Route::view('admin', 'admin.noticias.index');
Route::prefix('admin')->group(function () {
    // Noticias
    Route::resource('noticias', NoticiaController::class);

    // Certificaciones
    Route::controller(CertificacionController::class)->group(function () {
        Route::resource('certificaciones', CertificacionController::class);
        Route::get('certificaciones/get/list', 'list');
    });

    // Características
    Route::controller(CaracteristicaController::class)->group(function () {
        Route::resource('caracteristicas', CaracteristicaController::class);
        Route::get('caracteristicas/get/list', 'list')->name('caracteristicas.list');
    });

    // Quiénes somos
    Route::controller(QuienesSomosController::class)->group(function () {
        Route::resource('quienes-somos', QuienesSomosController::class);
    });

    // SubMercados
    Route::controller(SubMercadoController::class)->group(function () {
        Route::resource('submercados', SubMercadoController::class);
        Route::get('submercados/get/list', 'list')->name('submercados.list');
        Route::get('submercados/get/single/{subMercado}', 'get')->name('submercados.single');
    });

    // Comunas
    Route::controller(ComunaController::class)->group(function () {
        Route::get('comunas/get/list', 'comunasList')->name('comunas.list');
        Route::get('comunas/get/list/{regionName}', 'comunasPorRegionList')->name('comunas.por.region.list');
    });
});

Route::get('/', function () {
    return view('web.home');
});

Route::get('/contacto', function () {
    return view('web.contacto.index');
});
Route::get('/edificios-oficinas', function () {
    return view('web.edificios.index');
});
Route::get('/edificios-oficinas-detalle', function () {
    return view('web.edificios.detalle');
});
Route::get('/noticias', function () {
    return view('web.noticias.index');
});
Route::get('/noticias-detalle', function () {
    return view('web.noticias.detalle');
});
