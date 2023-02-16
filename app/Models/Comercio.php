<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Comercio extends Model
{
    use HasFactory;

    protected $table = 'locales_comerciales';

    protected $primaryKey = 'loc_id';

    public $timestamps = true;

    protected $fillable = [
        'loc_imagen',
        'loc_descripcion',
        'loc_edificio_id',
    ];

    protected $appends = [
        'nombreEdificio',
        'urlImagen'
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'loc_edificio_id', 'edi_id');
    }

    public function getNombreEdificioAttribute()
    {
        return $this->edificio->edi_nombre;
    }

    public function getUrlImagenAttribute()
    {
        return '/public' . Storage::url($this->loc_imagen);
    }
}
