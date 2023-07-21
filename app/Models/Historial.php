<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historials';

    protected $primaryKey = 'his_id';

    protected $fillable = [
        'his_formulario_edificio_id',
        'his_accion',
        'his_usuario',
        'his_estado',
    ];
}
