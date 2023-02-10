<?php

namespace App\Services;

use App\Models\Caracteristica;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;

class CaracteristicaService
{
    public static function registrarCaracteristica($request)
    {
        $caracteristica = Caracteristica::create([
            'car_nombre' => $request->nombre,
            'car_video_url' => $request->video,
            'car_posicion' => $request->posicion,
            'car_estado' => $request->estado,
            'car_imagen' => '',
        ]);

        $caracteristica->update([
            'car_imagen' => self::uploadImagen($request->file('imagen'), 'caracteristicas', $caracteristica->car_id),
        ]);
    }

    public static function actualizarCaracteristica($request, $caracteristica)
    {
        $caracteristica->update([
            'car_nombre' => $request->input('nombre'),
            'car_video_url' => $request->input('video'),
            'car_posicion' => $request->input('posicion'),
            'car_estado' => $request->input('estado'),
            'car_imagen' => self::uploadImagen($request->file('imagen'), 'caracteristicas', $caracteristica->car_id),
        ]);
    }

    public static function creacionVerificacionCarpetas($mainFolderName, $folderName)
    {
        try {
            //verificación y o creación de la carpeta para las imagenes basadas en el nombre de la pagina, utilizando su slug
            if (!file_exists(public_path('/storage/imagenes/' . $mainFolderName . '/' . $folderName))) {
                mkdir(public_path('/storage/imagenes/' . $mainFolderName . '/' . $folderName), 0755, true);
                return true;
            } elseif (file_exists(public_path('/storage/imagenes/' . $mainFolderName . '/' . $folderName))) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public static function uploadImagen($img, $mainFolderName, $folderName)
    {
        try {
            if ($img && self::creacionVerificacionCarpetas($mainFolderName, $folderName)) {
                $imgNewfileName = md5($img->getClientOriginalName());
                $img->move(public_path('/storage/imagenes/' . $mainFolderName . '/' . $folderName . '/'), $imgNewfileName . '.' . $img->getClientOriginalExtension());

                //ruta referencial
                return Storage::url('public/imagenes/' . $mainFolderName . '/' . $folderName . '/' . $imgNewfileName . '.' . $img->getClientOriginalExtension());
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

}
