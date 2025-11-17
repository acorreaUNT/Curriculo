<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caratula extends Model
{
    protected $table = 'caratulas';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'rcf',
        'rcu',
        'observacion',
        'conformidad',
        'color_letra',
        'color_fondo'
    ];

    public function programa(){
        return $this->belongsTo(ProgramaEstudios::class,'id_programa_estudios');
    }
}
