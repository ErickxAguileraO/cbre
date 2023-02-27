<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contacto';
    protected $primaryKey = 'con_id';
    public $timestamps = true;

    protected $fillable = [
        'con_nombre_completo', 'con_email', 'con_telefono', 'con_mensaje'
    ];

    protected $appends = [
        'fechaChile',
        'hora',
    ];

    public function getFechaChileAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    public function getHoraAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i');
    }

}
