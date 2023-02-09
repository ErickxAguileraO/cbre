<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Administracion\NoticiaController;

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
Route::prefix('admin')->group(function () {
    Route::resource('noticias', NoticiaController::class);
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
