<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoDepartamento extends Model
{
    protected $table = 'curso_departamentos';

    protected $fillable = [
        'id',
        'id_curso',
        'id_departamento',
        'coordinador'
    ];

    public function departamento(){
        return $this->belongsTo(Departamento::class,'id_departamento');
    }

    public function curso(){
        return $this->belongsTo(CursosPlanEstudios::class,'id_curso');
    }
}
