<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Formulario extends Model
{
    use HasFactory;

    protected $table = 'formularios';
    protected $primaryKey = 'form_id';
    public $timestamps = true;

    protected $fillable = [
        'form_funcionario_id',
        'form_nombre',
        'form_descripcion',
    ];

    protected $appends = [
        'fecha',
    ];

    public function getFechaAttribute()
    {
        return Carbon::parse($this->updated_at)->format('d-m-Y');
    }

    public function scopeWithFilters($query, $params)
    {
        return $query->when(isset($params['fechaInicio']), function ($query) use ($params) {
                $query->whereDate('updated_at', '>=', $params['fechaInicio']);
            })->when(isset($params['fechaTermino']), function ($query) use ($params) {
                $query->whereDate('updated_at', '<=', $params['fechaTermino']);
            })
            ->when(isset($params['edificio']), function ($query) use ($params) {
                $query->whereHas('edificios', function ($query) use ($params) {
                    $query->where('edi_nombre', $params['edificio']);
                });
            })
            ->when(isset($params['estado']), function ($query) use ($params) {
                $query->whereHas('edificios', function ($query) use ($params) {
                    $query->where('formulario_edificio.foredi_estado', $params['estado']);
                });
            })
            ->when(isset($params['creado_por']), function ($query) use ($params) {
                $query->when($params['creado_por'] !== 'Todos', function ($query) use ($params) {
                    $prevencionistas = User::role('prevencionista')->pluck('name')->toArray();
                    $tecnicos = User::role('tecnico')->pluck('name')->toArray();
                    $creadoPor = $params['creado_por'];

                    if ($creadoPor === 'Prevencionista' || $creadoPor === 'Técnico') {
                        $nombresFuncionarios = ($creadoPor === 'Prevencionista') ? $prevencionistas : $tecnicos;
                        $query->whereHas('funcionario', function ($query) use ($nombresFuncionarios) {
                            $query->whereIn('fun_nombre', $nombresFuncionarios);
                        });
                    }
                });
            });
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'form_funcionario_id', 'fun_id');
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'pre_formulario_id', 'form_id');
    }

    public function edificios(){
        return $this->belongsToMany(Edificio::class, 'formulario_edificio', 'foredi_formulario_id', 'foredi_edificio_id')->withTimestamps();
    }
}