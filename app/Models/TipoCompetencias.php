<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCompetencias extends Model
{
    protected $table = 'tipo_competencias';

    protected $fillable = [
        'id',
        'nombre',
    ];
}
