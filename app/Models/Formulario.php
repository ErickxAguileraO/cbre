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

    // public function scopeWithFilters($query)
    // {
    //     $proveedor = auth()->user()->proveedor;
    //     $id_planta = auth()->user()->usu_planta_id;

    //     return $query->when(request('inicio'), function ($query, $inicio) {
    //         $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') >= ?", [$inicio]);
    //     })->when(request('termino'), function ($query, $termino) {
    //         $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') <= ?", [$termino]);
    //     })->when((!$proveedor && !$id_planta) && request('planta'), function ($query) {
    //         $query->where('pag_planta_id', request('planta'));
    //     })->when($proveedor, function ($query, $proveedor) {
    //         $query->where('pag_identificacion', $proveedor->pro_identificacion);
    //     })->when($id_planta, function ($query, $id_planta) {
    //         $query->where('pag_planta_id', $id_planta);
    //     });
    // }
}
