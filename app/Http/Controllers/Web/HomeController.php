<?php

namespace App\Http\Controllers\Web;

use App\Models\Noticia;
use App\Models\Indicador;
use App\Models\QuienesSomos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificacion;
use App\Models\DatoGeneral;
use App\Models\Edificio;

class HomeController extends Controller
{
    public function home(){
        return view('web.home', [
            'quienes_somos' => QuienesSomos::first(),
            'indicadores' => Indicador::first(),
            'noticias' => Noticia::whereNull('not_edificio_id') // se deben mostrar las destacadas
                        ->orderBy('created_at', 'desc')
                        ->get(),
            'certificaciones' => Certificacion::all(),
            'edificios' => Edificio::all(),
        ]);
    }
}
