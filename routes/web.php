<?php

use App\Models\Edificio;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Administracion\ComunaController;
use App\Http\Controllers\Administracion\NoticiaController;
use App\Http\Controllers\Administracion\ComercioController;
use App\Http\Controllers\Administracion\ContactoController;
use App\Http\Controllers\Administracion\EdificioController;
use App\Http\Controllers\Administracion\IndicadorController;
use App\Http\Controllers\Administracion\SubMercadoController;
use App\Http\Controllers\Administracion\FuncionarioController;
use App\Http\Controllers\Administracion\QuienesSomosController;
use App\Http\Controllers\Administracion\AdministradorController;
use App\Http\Controllers\Administracion\CertificacionController;
use App\Http\Controllers\Administracion\CaracteristicaController;
use App\Http\Controllers\Administracion\DatosGeneralesController;
use App\Http\Controllers\Web\NoticiaController as WebNoticiaController;
use App\Http\Controllers\Web\ContactoController as WebContactoController;
use App\Http\Controllers\Web\EdificioController as  WebEdificioController;
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
Route::middleware(['guest'])->group(function () {
    Route::get('/logout', function () {
        abort(404);
    });
});
/**
 * Rutas para la administración
 */

Route::middleware(['auth'])->group(function () {
    Route::view('admin', 'admin.noticias.index');

    Route::prefix('admin')->group(function () {
        Route::group(['middleware' => ['role:super-admin']], function () {
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
                Route::get('quienes-somos/get/single', 'get')->name('quienes-somos.single');
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

            // Datos Empresa/Generales
            Route::controller(DatosGeneralesController::class)->group(function () {
                Route::resource('datos-generales', DatosGeneralesController::class);
                Route::get('datos-generales/get/single', 'get')->name('datos-generales.single');
            });

            // Indicadores
            Route::controller(IndicadorController::class)->group(function () {
                Route::resource('indicadores', IndicadorController::class);
            });

            // Locales comerciales
            Route::controller(ComercioController::class)->group(function () {
                Route::resource('comercios', ComercioController::class);
                Route::get('comercios/get/list', 'list');
            });

            // Administradores
            Route::controller(AdministradorController::class)->group(function () {
                Route::resource('administradores', AdministradorController::class);
                Route::get('administradores/get/list', 'list')->name('administradores.list');
                Route::post('administradores/restore/{administrador}', 'restore')->name('administradores.restore');
                Route::delete('administradores/force-destroy/{administrador}', 'forceDestroy')->name('administradores.force.destroy');
            });

            // Contactos
            Route::controller(ContactoController::class)->group(function () {
                Route::resource('contactos', ContactoController::class);
                Route::get('contactos/get/list', 'list')->name('contactos.list');
            });
        });

        // Noticias
        Route::controller(NoticiaController::class)->group(function () {
            Route::resource('noticias', NoticiaController::class);
            Route::get('noticias/get/list', 'list');
        });

        // Edificios
        Route::controller(EdificioController::class)->group(function () {
            Route::resource('edificios', EdificioController::class);
            Route::get('edificios/get/list', 'list');
        });

        // Funcionarios
        Route::controller(FuncionarioController::class)->group(function () {
            Route::resource('funcionarios', FuncionarioController::class);
            Route::get('funcionarios/get/list', 'list')->name('funcionarios.list');
        });
    });
});


Route::controller(HomeController::class)->group(function () {
    Route::group(['domain' => '{subdomain}.'.request()->getHost().''], function () {
        Route::get('/', function ($subdomain) {
            if(empty($subdomain)){
                return redirect()->route('web.home');
            }
            $edificio = Edificio::where('edi_subdominio', $subdomain)->firstOrFail();
            return redirect()->route('web.edificios.detalle', [$edificio->edi_id, Str::slug($edificio->edi_nombre , "-")]);
        });
    });
    Route::get('/', 'home')->name('web.home');
});


// Web Contactos
Route::controller(WebContactoController::class)->group(function () {
    Route::get('/contacto', function () {
        return view('web.contacto.index');
    });
    Route::post('contacto/store', 'store')->name('contacto.store');
});

// Web Edificios
Route::controller(WebEdificioController::class)->group(function () {
    Route::get('edificios-oficinas', 'index')->name('web.edificios.index');
    Route::get('edificios-oficinas/{edificio}-{slug}', 'detalle')->name('web.edificios.detalle');
    Route::get('edificios-oficinas/get/list', 'list')->name('web.edificios.list');
});

// Web Noticias
Route::controller(WebNoticiaController::class)->group(function () {
    Route::get('/noticias', function () {
        return view('web.noticias.index');
    });
    Route::get('noticias/{noticia}-{slug}', 'detalle')->name('web.noticias.detalle');
    Route::get('noticias/get/list', 'list')->name('web.noticias.list');
});

// Fomurlaio area tecnica
Route::get('/formulario-area-tecnica', function () {
    return view('admin.formulario_area_tecnica.index');
});
Route::get('/crear-formulario', function () {
    return view('admin.formulario_area_tecnica.create');
});
Route::get('/preview-formulario', function () {
    return view('admin.formulario_area_tecnica.preview');
});

// Mantencion area tecnica
Route::get('/mantencion-soporte-tecnico', function () {
    return view('admin.mantencion_soporte_tecnico.index');
});

// JOP
Route::get('/formularios-jop', function () {
    return view('admin.formularios_jop.index');
});

Route::get('/mantenciones-jop', function () {
    return view('admin.mantenciones_jop.index');
});