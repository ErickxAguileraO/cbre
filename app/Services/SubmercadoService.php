<?php

namespace App\Services;

use App\Models\Caracteristica;
use App\Models\SubMercado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;

class SubmercadoService
{

    public static function registrarSubMercado($request)
    {
        SubMercado::create([
            'sub_nombre' => $request->nombre,
            'sub_estado' => $request->estado,
            'sub_comuna_id' => $request->comuna,
        ]);
    }
}
