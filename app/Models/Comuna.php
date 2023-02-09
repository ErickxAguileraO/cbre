<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    use HasFactory;

    protected $table = 'comunas';
    protected $primaryKey = 'com_id';
    public $timestamps = true;

    protected $fillable = [
        'com_nombre',
        'com_region_id'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'com_region_id', 'reg_id');
    }
}
