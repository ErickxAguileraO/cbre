<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioEdificio extends Model
{
    use HasFactory;

    protected $table = 'formulario_edificio';

    protected $primaryKey = 'foredi_id';

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'res_formulario_edificio_id', 'foredi_id');
    }

}