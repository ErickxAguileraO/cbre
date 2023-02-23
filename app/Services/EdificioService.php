<?php

namespace App\Services;

use App\Models\Imagen;

use App\Models\Edificio;
use Illuminate\Support\Facades\Storage;

class EdificioService
{
    public static function subirGaleriaImagenes(Edificio $edificio, $galeriaImagenes)
    {
        $imagenesStorage = [];

        foreach ($galeriaImagenes as $imagen) {
            $pathImagen = ImagenService::subirImagen($imagen, 'edificios');
            
            if ( !$pathImagen ) {
                continue;
            }

            $imagenesStorage[] = [
                'ima_url' => $pathImagen
            ];
        }

        if ( count($imagenesStorage) == 0 ) {
            return false;
        }

        $edificio->imagenes()->createMany($imagenesStorage);

        return true;
    }

    public static function eliminarGaleriaImagenes(Edificio $edificio)
    {
        $imagenesStorage = [];

        foreach ($edificio->imagenes as $imagen) {
            $imagenesStorage[] = $imagen->ima_url;
        }

        Storage::delete($imagenesStorage);
        $edificio->imagenes()->delete();

        return true;
    }
}
