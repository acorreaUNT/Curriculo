<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{
    protected $table = 'plan_estudios';

    protected $fillable = [
        'id',
        'id_programa_estudios',
        'total_ht',
        'total_hp',
        'total_h',
        'total_creditos'
    ];


    function a_romano($integer, $upcase = true) 
    {
        $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 
                       'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9,   
                       'V'=>5, 'IV'=>4, 'I'=>1);
        $return = '';
        while($integer > 0) 
        {
            foreach($table as $rom=>$arb) 
            {
                if($integer >= $arb)
                {
                    $integer -= $arb;
                    $return .= $rom;
                    break;
                }
            }
        }
        return $return;
    }

    public function programa(){
        return $this->belongsTo(ProgramaEstudios::class,'id_programa_estudios');
    }

    
}
