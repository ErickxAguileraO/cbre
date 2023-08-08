<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoFormulario extends Model
{
    use HasFactory;

    protected $table = 'archivo_formularios';

    protected $primaryKey = 'arcf_id';

    protected $fillable = [
        'arcf_respuesta_id', 'arcf_pregunta_id', 'arcf_url', 'arcf_nombre_original'
    ];

    public function preguntas()
    {
        return $this->belongsTo(Pregunta::class, 'arcf_pregunta_id', 'pre_id');
    }

    public function respuestas()
    {
        return $this->belongsTo(Pregunta::class, 'arcf_respuesta_id', 'pre_id');
    }

}
