<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuienesSomos extends Model
{
    use HasFactory;

    protected $table = 'quienes_somos';
    protected $primaryKey = 'qus_id';
    public $timestamps = true;

    protected $fillable = [
        'qus_titulo', 'qus_texto', 'qus_imagen'
    ];
}
