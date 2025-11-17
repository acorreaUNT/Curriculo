<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursosPlanEstudios extends Model
{
    protected $table = 'cursos_plan_estudios';

    protected $fillable = [
        'id',
        'id_plan_estudio',
        'id_capacidad',
        'ciclo',
        'codigo',
        'nombre',
        'tipo',
        'naturaleza',
        'ht',
        'hp',
        'h_semana',
        'total_h',
        'creditos',
        'posicion',
        'color',
        'estado',
        'orden'
    ];

    public function planEstudios(){
        return $this->belongsTo(PlanEstudio::class,'id_plan_estudio');
    }

    public function capacidad(){
        return $this->belongsTo(Capacidades::class,'id_capacidad');
    }


    public function eliminar_tildes($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        $cadena = utf8_encode($cadena);
    
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
    
        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );
    
        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );
    
        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );
    
        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );
    
        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );
    
        return $cadena;
    }
}
