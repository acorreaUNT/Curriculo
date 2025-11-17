<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lineamiento extends Model
{
    protected $table = 'lineamientos';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];
}
