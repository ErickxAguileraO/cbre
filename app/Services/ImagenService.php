<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ImagenService
{
    public static function subirImagen($imagen, $directorio)
    {
        $path = "public/{$directorio}/imagenes";

        return Storage::putFileAs($path, $imagen, $imagen->hashName());
    }

    public static function subirGaleriaCroppie($directorio, $galeriaImagenes)
    {
        $imagenesStorage = [];

        foreach ($galeriaImagenes as $imagen) {
            $extension = Arr::last(explode('/', explode(';', $imagen)[0]));
            $hashName = Str::replace('/', '', Hash::make(microtime(true)));
            $nombreArchivo = Str::replace(".", "", $hashName) . '.' . $extension;
            $pathStorage = "public/{$directorio}/imagenes";
            $pathImagen = Storage::putFileAs($pathStorage, $imagen, $nombreArchivo);

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

        return $imagenesStorage;
    }
}
