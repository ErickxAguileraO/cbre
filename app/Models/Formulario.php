<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Formulario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'formularios';
    protected $primaryKey = 'form_id';
    public $timestamps = true;

    protected $fillable = [
        'form_nombre',
        'form_descripcion',
        'form_estado',
    ];

    protected $appends = [
        'fecha',
    ];

    public function getFechaAttribute()
    {
        return Carbon::parse($this->updated_at)->format('d-m-Y');
    }

    public function scopeWithFilters($query)
    {
        return $query->when(request('fechaInicio'), function ($query, $inicio) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') >= ?", [$inicio]);
        })->when(request('fechaTermino'), function ($query, $termino) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') <= ?", [$termino]);
        })->when(request('estado'), function ($query, $estado) {
            $query->where('form_estado', $estado);
        });
    }

    // public function formulariosEdificios()
    // {
    //     return $this->hasMany(FormularioEdificio::class, 'form_id');
    // }
}
