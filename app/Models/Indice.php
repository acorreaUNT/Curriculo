<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indice extends Model
{
    protected $table = 'indices';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'n_presentacion',
        'n_introduccion',
        'n_bases_generales',
        'n_bases_normativas',
        'n_bases_institucionales',
        'n_bases_teorica',
        'n_estudio_demanda',
        'n_obj_educacionales',
        'n_ejes_curriculares',
        'n_competencias',
        'n_genericas',
        'n_especificas',
        'n_perfiles',
        'n_perfil_ingreso',
        'n_perfil_egreso',
        'n_mapa_curricular',
        'n_malla_curricular',
        'n_plan_estudios',
        'n_sumilla',
        'n_estrategias_ensenanza',
        'n_lineamientos',
        'n_sistema_evaluacion',
        'n_eval_aprendizaje',
        'n_eval_logro',
        'n_eval_curricular',
        'n_referencias',
        'n_anexos'
    ];

}
