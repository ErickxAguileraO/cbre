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
            //'noticias' => Noticia::where('not_destacada', 1) // se deben mostrar las destacadas
            //'noticias' => Noticia::whereNull('not_edificio_id') // noticias generales
            'noticias' => Noticia::orderBy('created_at', 'desc')
                        ->get(),
            'certificaciones' => Certificacion::orderBy('cer_posicion', 'desc')->get(),
            'edificios' => Edificio::all(),
        ]);
    }
}
