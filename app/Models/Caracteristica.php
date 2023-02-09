<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $table = 'caracteristicas';
    protected $primaryKey = 'car_id';
    public $timestamps = true;

    protected $fillable = [
        'car_imagen', 'car_nombre', 'car_posicion', 'car_estado', 'car_video_url'
    ];

    public function edificios(){
        return $this->belongsToMany(Edificio::class)->withPivot('edi_id', 'car_id');
    }
}
