<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $table = 'presentacions';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];
}
