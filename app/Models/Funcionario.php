<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Funcionario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'funcionarios';

    protected $primaryKey = 'fun_id';

    protected $fillable = [
        'fun_nombre', 
        'fun_apellido', 
        'fun_telefono', 
        'fun_foto', 
        'fun_cargo', 
        'fun_user_id',
        'fun_edificio_id',
    ];

    protected $appends = [
        'urlImagen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fun_user_id', 'id');
    }

    public function userTrashed()
    {
        return $this->belongsTo(User::class, 'fun_user_id', 'id')->withTrashed();
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'fun_edificio_id', 'edi_id');
    }

    public function getUrlImagenAttribute()
    {
        return '/public' . Storage::url($this->fun_foto);
    }
}
