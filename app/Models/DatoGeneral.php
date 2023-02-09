<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoGeneral extends Model
{
    use HasFactory;

    protected $table = 'datos_generales';
    protected $primaryKey = 'dag_id';
    public $timestamps = true;

    protected $fillable = [
        'dag_direccion', 'dag_telefono_uno', 'dag_telefono_dos', 'dag_facebook', 'dag_linkedin', 'dag_instagram', 'dag_twitter', 'dag_youtube', 'dag_comuna_id'
    ];

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'dag_comuna_id', 'com_id');
    }
}
