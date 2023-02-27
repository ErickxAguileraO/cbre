<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';

    protected $primaryKey = 'ima_id';
    
    public $timestamps = true;

    protected $fillable = [
        'ima_url',
        'ima_edificio_id',
    ];

    protected $appends = [
        'urlImagen'
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'ima_edificio_id', 'edi_id');
    }

    public function getUrlImagenAttribute()
    {
        return '/public' . Storage::url($this->ima_url);
    }
}
