<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaOpcion extends Model
{
    use HasFactory;

    protected $table = 'respuesta_opcion';

    protected $primaryKey = 'reop_id';
}
