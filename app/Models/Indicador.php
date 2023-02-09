<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;

    protected $table = 'indicadores';
    protected $primaryKey = 'ind_id';
    public $timestamps = true;

    protected $fillable = [
        'ind_administrados', 'ind_confia_en_nosotros', 'ind_en_todo_chile', 'ind_en_todo_chile2'
    ];
}
