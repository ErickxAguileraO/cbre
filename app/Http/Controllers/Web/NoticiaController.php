<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
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
                'noticias' => Noticia::where('not_fecha', '<', Carbon::now('America/Santiago'))->orderBy('not_fecha', 'desc')
                ->skip(request('skip'))
                ->take(request('take'))
                ->get(),
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function detalle(Noticia $noticia, $slug){
        try {
            if(Str::slug($noticia->not_titulo , "-") != $slug || $noticia->not_fecha > Carbon::now('America/Santiago')){
                abort(404);
            }else{
                $protocol = request()->secure() ? 'https://' : 'http://';
                $shareComponent = ShareFacade::page(
                    $protocol.request()->getHost().'/'.'noticias'.'/'.$noticia->not_id.'-'.Str::slug($noticia->not_titulo , "-").'', $noticia->not_titulo
                )
                ->facebook()
                ->twitter()
                ->whatsapp();
                return view('web.noticias.detalle',compact('noticia', 'shareComponent'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()], 401);
        }
    }
}
