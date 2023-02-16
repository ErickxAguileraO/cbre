<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuienesSomos extends Model
{
    use HasFactory;

    protected $table = 'quienes_somos';
    protected $primaryKey = 'qus_id';
    public $timestamps = true;

    protected $fillable = [
        'qus_titulo', 'qus_texto', 'qus_imagen'
    ];

    protected $appends = [
        'urlImagen'
    ];

    public function getUrlImagenAttribute()
    {
        return '/public' . Storage::url($this->qus_imagen);
    }
}
