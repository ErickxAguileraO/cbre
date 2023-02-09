<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias';
    protected $primaryKey = 'not_id';
    protected $fillable = [
        'not_imagen',
        'not_titulo',
        'not_texto',
        'not_edificio_id'
    ];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'not_edificio_id', 'edi_id');
    }
}
