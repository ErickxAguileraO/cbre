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

}
