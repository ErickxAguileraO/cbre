<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $primaryKey = 'doc_id';

    protected $fillable = [
        'doc_nombre', 'doc_url', 'doc_extension', 'doc_edificio_id'
    ];

    protected $appends = [
        'urlDocumento',
    ];

    public function getUrlDocumentoAttribute()
    {
        return '/public' . Storage::url($this->doc_url);
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'doc_edificio_id', 'edi_id');
    }
}
