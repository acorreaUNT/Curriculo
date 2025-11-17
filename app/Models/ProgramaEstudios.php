<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProgramaEstudios extends Model
{
    protected $table = 'programa_estudios';

    protected $fillable = [
        'id',
        'id_user',
        'id_user2',
        'nombre_programa',
        'num_ciclos',
        'porcentaje',
        'ruta_archivo',
        'id_facultad'
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function supervisor(){
        return $this->belongsTo(User::class,'id_user2');
    }

    public function facultad(){
        return $this->belongsTo(Facultad::class,'id_facultad');
    }
}
