<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contacto';
    protected $primaryKey = 'con_id';
    public $timestamps = true;

    protected $fillable = [
        'con_nombre_completo', 'con_email', 'con_telefono', 'con_mensaje'
    ];
}
