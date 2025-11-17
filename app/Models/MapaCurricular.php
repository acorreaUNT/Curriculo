<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapaCurricular extends Model
{
    protected $table = 'mapa_curriculars';

    protected $fillable = [
        'id',
        'id_capacidad',
        'id_curso_plan_estudios'
    ];

    public function cursosPlan(){
        return $this->belongsTo(CursosPlanEstudios::class,'id_curso_plan_estudios');
    }
}
