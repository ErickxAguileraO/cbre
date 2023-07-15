<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    use HasFactory;

    protected $table = 'opcions';

    protected $primaryKey = 'opc_id';

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'opc_pregunta_id', 'pre_id');
    }

    public function respuestas(){
        return $this->belongsToMany(Respuesta::class, 'respuesta_opcion', 'reop_respuesta_id', 'reop_opcion_id')->withTimestamps();
    }


}
