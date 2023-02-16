<?php

namespace App\Services;

use App\Models\Caracteristica;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;

class DatosGeneralesService
{

    public static function actualizarDatosGenerales($request, $datosGenerales)
    {
        $datosGenerales->update([
            'dag_comuna_id' => $request->input('comuna'),
            'dag_direccion' => $request->input('direccion'),
            'dag_telefono_uno' => $request->input('telefono_uno'),
            'dag_telefono_dos' => $request->input('telefono_dos'),
            'dag_facebook' => $request->input('facebook'),
            'dag_linkedin' => $request->input('linkedin'),
            'dag_instagram' => $request->input('instagram'),
            'dag_twitter' => $request->input('twitter'),
            'dag_youtube' => $request->input('youtube'),
            'dag_email_encargado' => $request->input('email'),
        ]);
    }

}
