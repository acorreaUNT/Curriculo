<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introduccion extends Model
{
    protected $table = 'introduccions';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];

}
