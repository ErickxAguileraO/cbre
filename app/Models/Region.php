<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table = 'regiones';
    protected $primaryKey = 'reg_id';
    public $timestamps = true;

    protected $fillable = [
        'reg_nombre'
    ];

    public function comunas()
    {
        return $this->hasMany(Comuna::class, 'reg_comuna_id', 'reg_id');
    }
}
