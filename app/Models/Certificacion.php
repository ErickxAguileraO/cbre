<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'certificaciones';

    protected $primaryKey = 'cer_id';

    public $timestamps = true;

    protected $fillable = [
        'cer_imagen', 
        'cer_nombre', 
        'cer_posicion', 
        'cer_estado'
    ];

    protected $appends = [
        'estado'
    ];

    public function edificios(){
        return $this->belongsToMany(Edificio::class, 'edificio_certificacion', 'edce_certificacion_id', 'edce_edificio_id')->withTimestamps();
    }

    public function getEstadoAttribute()
    {
        return $this->cer_estado == 1 ? 'Activa' : 'Inactiva';
    }
}
