<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SistemaEvaluacion extends Model
{
    protected $table = 'sistema_evaluacions';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];
}
