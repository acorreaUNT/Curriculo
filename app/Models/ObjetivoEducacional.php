<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjetivoEducacional extends Model
{
    protected $table = 'objetivo_educacionals';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];
}
