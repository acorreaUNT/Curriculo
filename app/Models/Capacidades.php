<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacidades extends Model
{
    protected $table = 'capacidades';

    protected $fillable = [
        'id',
        'id_competencia',
        'codigo',
        'contenido'
    ];

    public function competencia(){
        return $this->belongsTo(Competencias::class,'id_competencia');
    }
}
