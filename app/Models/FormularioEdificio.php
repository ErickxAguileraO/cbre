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

    public function observacion()
    {
        return $this->hasMany(Obersacion::class, 'obs_formulario_edificio_id', 'foredi_id');
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'foredi_edificio_id', 'edi_id');
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class, 'foredi_formulario_id', 'form_id');
    }

}
