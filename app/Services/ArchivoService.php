<?php

namespace App\Services;

use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class ArchivoService
{

    public static function generateZip($formId)
    {
        $folderPath = public_path('/storage/archivos/'.$formId);

        $zipFilePath = public_path('/storage/'.$formId.'.zip');

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
            header('Content-Disposition: attachment; filename="archivos.zip"');
            header('Content-Length: ' . filesize($zipFilePath));
            readfile($zipFilePath);
            unlink($zipFilePath); // Remove the ZIP file after sending it

            exit;
        }

        return "Failed to generate the ZIP file.";
    }

    public static function subirArchivos($archivo, $carpeta, $subCarpeta){
        if($carpeta == 'mantencion'){
            // Archivos Mantención
            return $archivo->store('public/archivos/'.$carpeta.'/'.$subCarpeta);
        }else{
            // Archivos formularios
            return $archivo->store('public/archivos/'.$carpeta.'/preguntas/'.$subCarpeta);
        }
    }




}
