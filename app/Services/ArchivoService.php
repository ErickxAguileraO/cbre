<?php

namespace App\Services;

use ZipArchive;
use App\Models\Respuesta;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class ArchivoService
{
    // preguntaId puede ir como null, para así obtener la carpeta completa (form) y no solo la carpeta de la respectiva pregunta
    public static function generateZip($formId, $preguntaId)
    {
        if($preguntaId){
            $folderPath = public_path('/storage/archivos/'.$formId.'/preguntas/'.$preguntaId);
            $zipFilePath = public_path('/storage/archivos/'.$formId.'/preguntas/'.$preguntaId.'.zip');
        }else{
            $folderPath = public_path('/storage/archivos/'.$formId);
            $zipFilePath = public_path('/storage/archivos/'.$formId.'.zip');
        }

        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Get all the files in the folder
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($folderPath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // Skip directories
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 2);
                    // Add the file to the ZIP archive with its relative path
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();

            // Set the appropriate headers for the download
            header('Content-Type: application/zip');
            header("Content-Disposition: attachment; filename=\"archivos_" . date('Y-m-d_H-i-s') . ".zip\"");
            header('Content-Length: ' . filesize($zipFilePath));
            readfile($zipFilePath);
            unlink($zipFilePath); // Remove the ZIP file after sending it

            exit;
        }

        return "Failed to generate the ZIP file.";
    }

    public static function subirArchivos($archivo, $carpeta, $subCarpeta, $tipo){
        if($tipo == 'mantencion'){
            // Archivos Mantención
            return $archivo->store('public/archivos/'.$carpeta.'/'.$subCarpeta);
        }elseif($tipo == 'pregunta'){
            return $archivo->store('public/archivos/'.$carpeta.'/preguntas/'.$subCarpeta);
        }elseif($tipo == 'respuesta'){
            return $archivo->store('public/archivos/'.$carpeta.'/preguntas/'.$subCarpeta.'/respuestas/'.Respuesta::where('res_pregunta_id', $subCarpeta)->first()->res_id);
        }
    }




}
