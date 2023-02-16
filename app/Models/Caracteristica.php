<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caracteristica extends Model
{
    use HasFactory;

    protected $table = 'caracteristicas';
    protected $primaryKey = 'car_id';
    public $timestamps = true;

    protected $fillable = [
        'car_imagen', 'car_nombre', 'car_posicion', 'car_estado', 'car_video_url'
    ];

    protected $appends = [
        'urlImagen'
    ];

    public function getUrlImagenAttribute()
    {
        return '/public' . Storage::url($this->car_imagen);
    }

    public function edificios(){
        return $this->belongsToMany(Edificio::class)->withPivot('edi_id', 'car_id');
    }
}
