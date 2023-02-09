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
        'ubi_coordenadas'
    ];

    public function submercado()
    {
        return $this->belongsTo(SubMercado::class, 'edi_submercado_id', 'sub_id');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany(Caracteristica::class)->withPivot('album_id', 'car_id');
    }

    public function certificaciones()
    {
        return $this->belongsToMany(Certificacion::class)->withPivot('album_id', 'cer_id');
    }
}
