<?php

namespace App\Http\Controllers\Web;

use App\Models\Edificio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EdificioController extends Controller
{
    public function list(){
        try {
            return response()->json([
                'edificios' => Edificio::with(['submercado.comuna.region'])->orderBy('created_at', 'desc')
                ->skip(request('skip'))
                ->take(request('take'))
                ->get(),
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function detalle(Edificio $edificio, $slug){
        try {
            if(Str::slug($edificio->edi_nombre , "-") != $slug){
                abort(404);
            }else{
                return view('web.edificios.detalle',compact('edificio'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
