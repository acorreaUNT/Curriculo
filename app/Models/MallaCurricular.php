<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MallaCurricular extends Model
{
    protected $table = 'malla_curriculars';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'malla'
    ];

    
}
