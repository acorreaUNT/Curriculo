<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Graduacion extends Model
{
    protected $table = 'graduacions';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];
}
