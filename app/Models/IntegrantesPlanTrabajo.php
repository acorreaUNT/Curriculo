<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrantesPlanTrabajo extends Model
{
    protected $table = 'integrantes_plan_trabajos';

    protected $fillable = [
        'id',
        'id_plan_trabajo',
        'apellido',
        'nombre',
        'cargo',
        'firma',
    ];

    public function plan_trabajo(){
        return $this->belongsTo(PlanTrabajo::class,'id_plan_trabajo');
    }
}
