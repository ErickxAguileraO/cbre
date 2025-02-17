<?php

namespace App\Http\Controllers\Web;

use App\Models\Edificio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubMercado;

class EdificioController extends Controller
{

    public function index(){
        return view('web.edificios.index', ['submercados' => SubMercado::all()]);
    }

    public function list(){
        try {
            if(request('submercado') === 'null'){
                return response()->json([
                    'edificios' => Edificio::with(['submercado.comuna.region'])->orderBy('edi_nombre')
                    ->skip(request('skip'))
                    ->take(request('take'))
                    ->get(),
                    'total' => Edificio::with(['submercado.comuna.region'])->orderBy('edi_nombre')
                    ->count()
                ]);
            }else{
                return response()->json([
                    'edificios' => Edificio::where('edi_submercado_id', request('submercado'))->with(['submercado.comuna.region'])->orderBy('edi_nombre')
                    ->skip(request('skip'))
                    ->take(request('take'))
                    ->get(),
                    'total' => Edificio::where('edi_submercado_id', request('submercado'))->with(['submercado.comuna.region'])->orderBy('edi_nombre')
                    ->count()
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function detalle(Edificio $edificio, $slug){
        try {
            if(Str::slug($edificio->edi_nombre , "-") != $slug){
                abort(404);
            }else{
                return view('web.edificios.detalle', compact('edificio'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
