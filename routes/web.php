<?php

use App\Http\Controllers\Administracion\CaracteristicaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Administracion\NoticiaController;
use App\Http\Controllers\Administracion\CertificacionController;
use App\Http\Controllers\Administracion\QuienesSomosController;
use App\Models\Caracteristica;

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
        Route::get('quienes-somos/get/list', 'list')->name('quienes-somos.list');
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
