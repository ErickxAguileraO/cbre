<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Noticia;
use App\Models\Edificio;
use App\Models\Indicador;
use App\Models\DatoGeneral;
use App\Models\QuienesSomos;
use Illuminate\Http\Request;
use App\Models\Certificacion;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        return view('web.home', [
            'quienes_somos' => QuienesSomos::first(),
            'indicadores' => Indicador::first(),
            'noticias' => Noticia::where('not_destacada', 1)->where('not_fecha', '<', Carbon::now('America/Santiago'))->orderBy('not_fecha', 'desc')->take(6)
                        ->get(),
            'certificaciones' => Certificacion::orderBy('cer_posicion', 'desc')->get(),
            'edificios' => Edificio::all(),
        ]);
    }
}
