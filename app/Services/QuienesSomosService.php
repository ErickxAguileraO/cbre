<?php

namespace App\Services;

use App\Models\Caracteristica;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;

class QuienesSomosService
{

    public static function actualizarQuienesSomos($request, $quienesSomos)
    {
        $quienesSomos->update([
            'qus_titulo' => $request->input('titulo'),
            'qus_texto' => $request->input('texto'),
            'qus_imagen' => ImagenService::subirImagen($request->file('imagen'), 'quienes-somos'),
        ]);
    }

}
