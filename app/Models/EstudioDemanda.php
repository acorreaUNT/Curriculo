<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstudioDemanda extends Model
{
    protected $table = 'estudio_demandas';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'influencia_programa',
        'laboral_profesional',
        'demanda_formativa',
        'pertinencia_social',
        'modalidades_estudio'
    ];
}
