<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';
    protected $primaryKey = 'fun_id';
    protected $fillable = [
        'fun_nombre', 'fun_apellido', 'fun_telefono', 'fun_foto', 'fun_cargo', 'fun_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fun_user_id', 'id');
    }
}
