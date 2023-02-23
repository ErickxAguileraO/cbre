<?php

namespace App\Services;

use App\Models\Imagen;

use App\Models\Edificio;

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
}
