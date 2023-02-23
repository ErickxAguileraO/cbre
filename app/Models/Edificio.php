<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;

    protected $table = 'edificios';

    protected $primaryKey = 'edi_id';

    protected $fillable = [
        'edi_nombre',
        'edi_descripcion',
        'edi_direccion',
        'edi_imagen',
        'edi_submercado_id',
        'ubi_titulo',
        'ubi_descripcion',
        'edi_latitud',
        'edi_longitud',
        'edi_video',
        'edi_subdominio',
    ];

    public function submercado()
    {
        return $this->belongsTo(SubMercado::class, 'edi_submercado_id', 'sub_id');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany(Caracteristica::class, 'edificio_caracteristica', 'edca_edificio_id', 'edca_caracteristica_id')->withTimestamps();
    }

    public function certificaciones()
    {
        return $this->belongsToMany(Certificacion::class, 'edificio_certificacion', 'edce_edificio_id', 'edce_certificacion_id')->withTimestamps();
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'ima_edificio_id', 'edi_id');
    }
}
