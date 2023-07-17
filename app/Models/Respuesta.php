<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = 'respuestas';

    protected $primaryKey = 'res_id';

    public function opciones(){
        return $this->belongsToMany(Opcion::class, 'respuesta_opcion', 'reop_opcion_id', 'reop_respuesta_id')->withTimestamps();
    }

    public function formularioEdificio()
    {
        return $this->belongsTo(FormularioEdificio::class, 'res_formulario_edificio_id', 'foredi_id');
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'res_pregunta_id', 'pre_id');
    }

    public function archivosFormulario()
    {
        return $this->hasMany(ArchivoFormulario::class, 'arcf_respuesta_id', 'res_id');
    }


}
