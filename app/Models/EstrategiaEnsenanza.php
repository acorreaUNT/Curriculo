<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstrategiaEnsenanza extends Model
{
    protected $table = 'estrategia_ensenanzas';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'contenido'
    ];
}
