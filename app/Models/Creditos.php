<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creditos extends Model
{
    protected $table = 'creditos';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];

}
