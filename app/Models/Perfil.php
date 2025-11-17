<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfils';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'ingreso',
        'egreso',
        'objetivos_programa',
        'objetivos_educacionales'
    ];
}
