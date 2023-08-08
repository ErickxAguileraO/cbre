<?php

namespace App\Services;

use ZipArchive;
use FilesystemIterator;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Formulario;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use RecursiveCallbackFilterIterator;

class DocumentoService
{
    public static function subirDocumento($documento, $subCarpeta){
        return $documento->store('public/documento/'.$subCarpeta);
    }

}
