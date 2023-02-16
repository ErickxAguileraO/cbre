<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Noticia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'noticias';

    protected $primaryKey = 'not_id';

    protected $fillable = [
        'not_imagen',
        'not_titulo',
        'not_texto',
        'not_edificio_id'
    ];

    protected $appends = [
        'nombreEdificio',
        'fechaChile',
        'hora'
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'not_edificio_id', 'edi_id');
    }

    public function getNombreEdificioAttribute()
    {
        return $this->edificio != null ? $this->edificio->edi_nombre : '';
    }

    public function getFechaChileAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    public function getHoraAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i');
    }
}
