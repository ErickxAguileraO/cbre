<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoMantencion extends Model
{
    use HasFactory;

    protected $table = 'archivo_mantencions';

    protected $primaryKey = 'arcm_id';

    protected $fillable = [
        'arcm_mantencion_id',
        'arcm_url',
    ];

    public function mantenciones()
    {
        return $this->belongsTo(Pregunta::class, 'arcm_mantencion_id', 'man_id');
    }
}
