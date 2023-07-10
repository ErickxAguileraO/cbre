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
        'form_funcionario_id',
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
            $query->whereDate('updated_at', '>=', $inicio);
        })->when(request('fechaTermino'), function ($query, $termino) {
            $query->whereDate('updated_at', '<=', $termino);
        })->when(request('estado'), function ($query, $estado) {
            $query->where('form_estado', $estado);
        })->when(request('creado_por'), function ($query, $creadoPor) {
            $query->whereHas('funcionario', function ($query) use ($creadoPor) {
                $query->where('fun_nombre', $creadoPor);
            });
        });
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'form_funcionario_id', 'fun_id');
    }
}
