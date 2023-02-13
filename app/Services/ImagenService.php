<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImagenService
{
    public static function subirImagen($imagen, $directorio)
    {
        $path = "public/{$directorio}/imagenes";
        $nombre = "{$imagen->hashName()}.{$imagen->extension()}";
        
        return Storage::putFileAs($path, $imagen, $nombre);
    }
}
