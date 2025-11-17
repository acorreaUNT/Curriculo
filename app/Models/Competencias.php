<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencias extends Model
{
    protected $table = 'competencias';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'id_tipo_competencia',
        'nombre',
        'codigo',
        'contenido'
    ];

    public function tipoCompetencia(){
        return $this->belongsTo(TipoCompetencias::class,'id_tipo_competencia');
    }
}
