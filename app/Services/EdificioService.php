<?php

namespace App\Services;

use App\Models\Imagen;

use App\Models\Edificio;
use Illuminate\Support\Facades\Storage;

class EdificioService
{
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

    public function actualizarGaleriaImagenes(Edificio $edificio)
    {
        //obtenemos los nombres de imagenes que fueron eliminados en pantalla
        $nombres = $edificio->imagenes->whereNotIn('ima_id', request('idImagenes', []))->get()->pluck('nombre');
    }
}
