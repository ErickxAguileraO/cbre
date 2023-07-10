<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListadoMantencion extends Model
{
    use HasFactory;

    protected $table = 'listado_mantencions';
    protected $primaryKey = 'lism_id';
    public $timestamps = true;

    protected $fillable = [
        'lism_nombre',
        'lism_estado',
    ];

    public function mantenciones()
    {
        return $this->hasMany(Mantencion::class, 'man_listado_mantencions_id');
    }
}
