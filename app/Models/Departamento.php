<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';

    protected $fillable = [
        'id',
        'nombre_departamento',
        'id_facultad'
    ];

    public function facultad(){
        return $this->belongsTo(Facultad::class,'id_facultad');
    }
}
