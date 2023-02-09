<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores';
    protected $primaryKey = 'adm_id';
    protected $fillable = [
        'adm_nombre', 'adm_apellido', 'adm_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'adm_user_id', 'id');
    }
}
