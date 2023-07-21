<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obersacion extends Model
{
    use HasFactory;

    protected $table = 'observaciones';
    protected $primaryKey = 'obs_id';
    public $timestamps = true;

    protected $fillable = [
        'obs_descripcion_id',
        'obs_formulario_edificio_id',
        'obs_estado',
    ];
}
