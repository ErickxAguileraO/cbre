<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'preguntas';

    protected $primaryKey = 'pre_id';

    protected $fillable = [
        'pre_pregunta',
        'pre_obligatorio',
    ];

    public function formulario()
    {
        return $this->belongsTo(Formulario::class, 'pre_formulario_id', 'form_id');
    }

    public function tipoPregunta()
    {
        return $this->belongsTo(TipoPregunta::class, 'pre_tipo_pregunta_id', 'tipp_id');
    }

    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'opc_pregunta_id', 'pre_id');
    }

    public function archivosFormulario()
    {
        return $this->hasMany(ArchivoFormulario::class, 'arcf_pregunta_id', 'pre_id');
    }

}
