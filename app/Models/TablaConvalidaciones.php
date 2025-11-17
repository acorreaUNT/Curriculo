<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaConvalidaciones extends Model
{
    protected $table = 'tabla_convalidaciones';

    protected $fillable = [
        'id',
        'id_programa_estudios'
    ];
}
