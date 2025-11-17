<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table = 'referencias';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];
}
