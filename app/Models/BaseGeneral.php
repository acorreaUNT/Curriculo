<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseGeneral extends Model
{
    protected $table = 'base_generals';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'bn_contenido',
        'bi_fac_mision',
        'bi_fac_vision',
        'bi_men_mision',
        'bi_men_vision',
        'bi_principios_facultad',
        'concepcion_humano',
        'concepcion_episte',
        'concepcion_curricular'
    ];
}
