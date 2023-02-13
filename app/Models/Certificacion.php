<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    use HasFactory;

    protected $table = 'certificaciones';

    protected $primaryKey = 'cer_id';

    public $timestamps = true;

    protected $fillable = [
        'cer_imagen', 
        'cer_nombre', 
        'cer_posicion', 
        'cer_estado'
    ];

    public function edificios(){
        return $this->belongsToMany(Edificio::class, 'edificio_certificacion', 'edce_certificacion_id', 'edce_edificio_id')->withTimestamps();
    }
}
