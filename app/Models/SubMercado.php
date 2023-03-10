<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMercado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'submercados';
    protected $primaryKey = 'sub_id';
    public $timestamps = true;

    protected $fillable = [
        'sub_estado', 'sub_nombre', 'sub_comuna_id'
    ];

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'sub_comuna_id', 'com_id');
    }

    public function edificios()
    {
        return $this->hasMany(Edificio::class, 'edi_submercado_id', 'sub_id');
    }
}
