<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Fake delay
    |--------------------------------------------------------------------------
    |
    | En este apartado se especificará el contenido de los "unsleep" que se
    | implementaron en cada una de las funciones de los componentes de Livewire
    | Esto para reducir la carga del servidor de desarrollo (muy lento),
    | y par aposteriori poder bajar el tiempo en caso de pasar a un servidor
    | con una respuesta más rapida (menos de 800ms-1000ms)
    |
    | 1 segundo = 1000000
    | 700ms = 700000
    | 200ms = 200000
    |
    */

    'general' => 1000000, // Nueva Pregunta, Nuevas opciones, Borrar pregunta, borrar opción, Defer change, Respuestas
    'attach_edificio' => 400000, // Attach edificios y detach edificios
    'file_gestor' => 400000, // Despliega el modal para gestinar archivos, así como adjuntarlos y eliminarlos
    'save' => 3000000, // Botón de "guardar"


];
