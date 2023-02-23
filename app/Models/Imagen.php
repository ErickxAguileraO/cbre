<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'ima_edificio_id', 'edi_id');
    }
}
