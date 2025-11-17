<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contextualizacion extends Model
{
    protected $table = 'contextualizacions';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'sintesis',
        'determinacion',
        'desarrollo'
    ];
}
