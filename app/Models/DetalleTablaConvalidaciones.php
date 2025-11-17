<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleTablaConvalidaciones extends Model
{
    protected $table = 'detalle_tabla_convalidaciones';

    protected $fillable = [
        'id',
        'id_tabla_convalidaciones',
        'ciclo',
        'credito',
        'nombre_curso',
        'id_curso_plan_estudios',
        'nombre_curso_extracurricular'
    ];


    public function cursos(){
        return $this->belongsTo(CursosPlanEstudios::class,'id_curso_plan_estudios');
    }
}
