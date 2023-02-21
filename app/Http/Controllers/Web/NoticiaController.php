<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    public function list(){
        return response()->json([
            'noticias' => Noticia::whereNull('not_edificio_id')
            ->orderBy('created_at', 'desc')
            ->skip(request('skip'))
            ->take(request('take'))
            ->get(),
        ]);
    }
}
