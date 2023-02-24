<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DatoGeneral extends Model
{
    use HasFactory;

    protected $table = 'datos_generales';
    protected $primaryKey = 'dag_id';
    public $timestamps = true;

    protected $fillable = [
        'dag_direccion', 'dag_telefono_uno', 'dag_telefono_dos', 'dag_facebook', 'dag_linkedin', 'dag_instagram', 'dag_twitter', 'dag_youtube', 'dag_comuna_id',
        'dag_email_encargado', 'dag_nombre_encargado', 'dag_telefono_encargado', 'dag_cargo_encargado', 'dag_imagen_encargado'
    ];

    protected $appends = [
        'urlImagen'
    ];

    public function getUrlImagenAttribute()
    {
        return '/public' . Storage::url($this->dag_imagen_encargado);
    }

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'dag_comuna_id', 'com_id');
    }
}
