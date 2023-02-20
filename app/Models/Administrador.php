<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'administradores';

    protected $primaryKey = 'adm_id';

    protected $fillable = [
        'adm_nombre', 'adm_apellido', 'adm_user_id'
    ];

    protected $appends = [
        'nombreCompleto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'adm_user_id', 'id');
    }

    public function userTrashed()
    {
        return $this->belongsTo(User::class, 'adm_user_id', 'id')->withTrashed();
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->adm_nombre} {$this->adm_apellido}";
    }
}
