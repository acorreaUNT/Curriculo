<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EjeCurricular extends Model
{
    protected $table = 'eje_curriculars';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'responsabilidad_social',
        'investigacion_formativa',
        'idi',
        'sostenibilidad_ambiental',
        'etica',
        'identidad',
        'multidisciplinaria'
    ];
}
