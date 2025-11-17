<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanTrabajo extends Model
{
    protected $table = 'plan_trabajos';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'facultad',
        'nro_resolucion',
        'contextualizacion',
        'resolucion',
        'acta_aprobacion',
        'evidencias',
        'ruta_archivo',
        'observacion',
        'conformidad'
    ];


    public function programa(){
        return $this->belongsTo(ProgramaEstudios::class,'id_programa_estudios');
    }
}
