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

    public function descartarImagenes(Edificio $edificio, $idsImagenesDescartadas)
    {
        $imagenesDescartadas = $edificio->imagenes->whereNotIn('ima_id', $idsImagenesDescartadas)->pluck('ima_url');
        $edificio->imagenes()->whereNotIn('ima_id', $idsImagenesDescartadas)->delete();
        Storage::delete($imagenesDescartadas);

        return true;
    }
}
