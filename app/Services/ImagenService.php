<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImagenService
{
    public static function subirImagen($imagen, $directorio)
    {
        $path = "public/{$directorio}/imagenes";

        return Storage::putFileAs($path, $imagen, $imagen->hashName());
    }
}
