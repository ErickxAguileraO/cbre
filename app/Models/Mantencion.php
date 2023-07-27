<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mantencion extends Model
{
    use HasFactory;
    protected $table = 'mantencions';
    protected $primaryKey = 'man_id';
    public $timestamps = true;

    protected $fillable = [
        'man_listado_mantencions_id',
        'man_edificio_id',
        'man_descripcion',
    ];

    protected $appends = [
        'fecha',
    ];

    public function getFechaAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    public function scopeWithFilters($query)
    {
        return $query->when(request('fechaInicio'), function ($query, $inicio) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') >= ?", [$inicio]);
        })->when(request('fechaTermino'), function ($query, $termino) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') <= ?", [$termino]);
        })->when(request('especialidad'), function ($query, $especialidad) {
            $query->whereHas('listadoMantencion', function ($query) use ($especialidad) {
                $query->where('lism_nombre', $especialidad);
            });
        })->when(request('edificio'), function ($query, $edificio) {
            $query->whereHas('edificios', function ($query) use ($edificio) {
                $query->where('edi_nombre', $edificio);
            });
        });
    }

    public function listadoMantencion()
    {
        return $this->belongsTo(ListadoMantencion::class, 'man_listado_mantencions_id', 'lism_id');
    }

    public function edificios()
    {
        return $this->belongsTo(Edificio::class, 'man_edificio_id', 'edi_id');
    }

    public function archivosMantencion()
    {
        return $this->hasMany(ArchivoFormulario::class, 'arcm_mantencion_id', 'man_id');
    }
}
