<?php

namespace App\Http\Controllers\Web;

use App\Models\Noticia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;
use App\Http\Controllers\Controller;

class NoticiaController extends Controller
{
    public function list(){
        try {
            return response()->json([
                'noticias' => Noticia::whereNull('not_edificio_id')
                ->orderBy('created_at', 'desc')
                ->skip(request('skip'))
                ->take(request('take'))
                ->get(),
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function detalle(Noticia $noticia,$slug){
        try {
            if(Str::slug($noticia->not_titulo , "-") != $slug){
                abort(404);
            }else{
                $shareComponent = ShareFacade::page(
                    request()->secure() ? 'https://' : 'http://'.request()->getHost().'/'.$noticia->not_id.'-'.Str::slug($noticia->not_titulo , "-").'',Str::slug($noticia->not_titulo , "-")
                )
                ->facebook()
                ->twitter()
                ->whatsapp();
                return view('web.noticias.detalle',compact('noticia', 'shareComponent'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
