<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoRequisito extends Model
{
    protected $table = 'curso_requisitos';

    protected $fillable = [
        'id',
        'id_curso',
        'id_requisito',
    ];

    public function requisito(){
        return $this->belongsTo(CursosPlanEstudios::class,'id_requisito');
    }
}
