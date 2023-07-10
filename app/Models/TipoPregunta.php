<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPregunta extends Model
{
    use HasFactory;

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'pre_tipo_pregunta_id', 'tipp_id');
    }
}

