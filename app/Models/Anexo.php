<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $table = 'anexos';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'anexo'
    ];
}
