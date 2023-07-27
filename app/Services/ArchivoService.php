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

class ArchivoService
{
    public static function generateZip($formId, $preguntaId, $respuestaId)
    {
        if($formId && $preguntaId == 0 && $respuestaId){
            $respuesta = Respuesta::findOrFail($respuestaId);
            $folderPath = public_path('/storage/archivos/'.$formId.'/preguntas/'.$respuesta->pregunta->pre_id.'/respuesta'.'/edificio'.'/'.$respuesta->formularioEdificio->foredi_id.'/'.$respuesta->res_id);
            $zipFilePath = public_path('/storage/archivos/'.$formId.'/preguntas/'.$respuesta->pregunta->pre_id.'/respuesta'.'/edificio'.'/'.$respuesta->formularioEdificio->foredi_id.'/'.$respuesta->res_id. '.zip');
        }elseif($formId && $preguntaId && $respuestaId == 0){
            $folderPath = public_path('/storage/archivos/'.$formId.'/preguntas/'.$preguntaId);
            $zipFilePath = public_path('/storage/archivos/'.$formId.'/preguntas/'.$preguntaId.'.zip');
        }elseif($formId && $preguntaId == 0 && $respuestaId == 0){
            $folderPath = public_path('/storage/archivos/'.$formId);
            $zipFilePath = public_path('/storage/archivos/'.$formId.'.zip');
        }

        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

            if($formId && $preguntaId == 0 && $respuestaId == 0){
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($folderPath, FilesystemIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($folderPath) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }else{
                $filter = function ($file, $key, $iterator) {
                    return $file->isFile();
                };

                $files = new RecursiveIteratorIterator(
                    new RecursiveCallbackFilterIterator(
                        new RecursiveDirectoryIterator($folderPath, FilesystemIterator::SKIP_DOTS),
                        $filter
                    ),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();

            $form_nombre = Formulario::find($formId)->form_nombre;

            header('Content-Type: application/zip');
            header("Content-Disposition: attachment; filename=\"".$form_nombre."-" . date('Y-m-d_H-i-s') . ".zip\"");
            header('Content-Length: ' . filesize($zipFilePath));
            readfile($zipFilePath);
            unlink($zipFilePath);

            exit;
        }

        return "Failed to generate the ZIP file.";
    }


    public static function generateZipMantenciones($mantencionId,$idCarpeta)
    {
        if($idCarpeta){
            $folderPath = public_path('/storage/archivos/mantencion/'.$mantencionId);
            $zipFilePath = public_path('/storage/archivos/mantencion/'.$mantencionId.'.zip');
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
            return $archivo->store('public/archivos/'.$carpeta.'/'.$subCarpeta);
        }elseif($tipo == 'pregunta'){
            return $archivo->store('public/archivos/'.$carpeta.'/preguntas/'.$subCarpeta);
        }elseif($tipo == 'respuesta'){
            $respuesta = Respuesta::findOrFail($subCarpeta);
            return $archivo->store('public/archivos/'.$carpeta.'/preguntas/'.$respuesta->pregunta->pre_id.'/respuesta'.'/edificio'.'/'.$respuesta->formularioEdificio->foredi_id.'/'.$respuesta->res_id);
        }
    }

}
