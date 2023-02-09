<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalComercial extends Model
{
    use HasFactory;

    protected $table = 'locales_comerciales';
    protected $primaryKey = 'loc_id';
    public $timestamps = true;

    protected $fillable = [
        'loc_imagen',
        'loc_descripcion',
        'loc_edificio_id',
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'loc_edificio_id', 'edi_id');
    }
}
