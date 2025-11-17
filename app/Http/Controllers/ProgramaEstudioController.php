<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\PlanEstudio;
use App\Models\CursoDepartamento;
use App\Models\CursosPlanEstudios;
use App\Models\Competencias;
use App\Models\Capacidades;
use App\Models\MapaCurricular;
use App\Models\Sumilla;
use App\Models\Facultad;
use App\User;

class ProgramaEstudioController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }

    //GENERAR COMPETENCIA
    public function competencias($id_programa_estudios){
        //competencia 1
        $competencia1 = new Competencias();
        $competencia1->id_programa_estudios = $id_programa_estudios;
        $competencia1->id_tipo_competencia = 1;
        $competencia1->codigo = 'G1';
        $competencia1->nombre = 'COMPETENCIA INSTRUMENTAL';
        $competencia1->contenido = 'Gestiona sus habilidades investigativas utilizando el razonamiento lógico-matemático, la comunicación efectiva, el saber popular y el conocimiento científicotecnológico para comprender racionalmente la realidad y aportar soluciones a los problemas diversos de la región y del país.';
        $competencia1->save();

        //competencia 2
        $competencia2 = new Competencias();
        $competencia2->id_programa_estudios = $id_programa_estudios;
        $competencia2->id_tipo_competencia = 1;
        $competencia2->codigo = 'G2';
        $competencia2->nombre = 'COMPETENCIA INTERPERSONAL';
        $competencia2->contenido = 'Gestiona sus habilidades investigativas utilizando el razonamiento lógico-matemático, la comunicación efectiva, el saber popular y el conocimiento científicotecnológico para comprender racionalmente la realidad y aportar soluciones a los problemas diversos de la región y del país.';
        $competencia2->save();

        //competencia 3
        $competencia3 = new Competencias();
        $competencia3->id_programa_estudios = $id_programa_estudios;
        $competencia3->id_tipo_competencia = 1;
        $competencia3->codigo = 'G3';
        $competencia3->nombre = 'COMPETENCIA SISTÉMICA';
        $competencia3->contenido = 'Gestiona sus aprendizajes de modo integral, autónomo y continuo, adaptándose a situaciones nuevas, con respeto a los demás con actitud emprendedora, identidad y compromiso con la promoción del desarrollo sostenible en un crítico contexto global.';
        $competencia3->save();

        $this->capacidades($competencia1->id, $competencia2->id, $competencia3->id);
    }
    
    //GENERAR CAPACIDADES
    public function capacidades($id_competencia_1, $id_competencia_2, $id_competencia_3){
        //capacidad 1
        $capacidad1 = new Capacidades();
        $capacidad1->id_competencia = $id_competencia_1;
        $capacidad1->codigo = 'G1.01';
        $capacidad1->contenido = 'Aplica el instrumental teórico de la Epistemología, la Lógica y la Matemática para analizar la realidad y desarrollar crítica y creativamente los procesos de la investigación científica y tecnológica, generando alternativas de solución a problemas cotidianos, científicos, tecnológicos y humanos.';
        $capacidad1->save();

        //capacidad 2
        $capacidad2 = new Capacidades();
        $capacidad2->id_competencia = $id_competencia_1;
        $capacidad2->codigo = 'G1.02';
        $capacidad2->contenido = 'Emplea los fundamentos, técnicas y recursos de la comunicación oral y escrita, para analizar, comprender y sistematizar información y textos, preferentemente académicos, y así poder argumentar, con sentido lógico y crítico, propuestas creativas, consistentes y viables de solución ante la problemática regional y nacional dentro del contexto global.';
        $capacidad2->save();

        //capacidad 3
        $capacidad3 = new Capacidades();
        $capacidad3->id_competencia = $id_competencia_2;
        $capacidad3->codigo = 'G2.01';
        $capacidad3->contenido = 'Participa en actividades de promoción, difusión ydefensa de los derechos humanos demostrando respeto por sí mismo y por los demás, sensibilidad social, manejo de su inteligencia emocional, criticidad, asertividad, civismo y eticidad para la construcción de una sociedad inclusiva, justa y democrática.';
        $capacidad3->save();

        //capacidad 4
        $capacidad4 = new Capacidades();
        $capacidad4->id_competencia = $id_competencia_2;
        $capacidad4->codigo = 'G2.02';
        $capacidad4->contenido = 'Practica actividades deportivas, artísticas y recreacionales con disciplina, responsabilidad y respeto para el cuidado y desarrollo integral de su salud física y mental y mejora de su interrelación social.';
        $capacidad4->save();

        //capacidad 5
        $capacidad5 = new Capacidades();
        $capacidad5->id_competencia = $id_competencia_3;
        $capacidad5->codigo = 'G3.01';
        $capacidad5->contenido = 'Demuestra un manejo adecuado y eficiente de sus aprendizajes, actitudes emprendedoras, iniciativa, creatividad, liderazgo y trabajo en equipo, al analizar problemas de su entorno y aportando al desarrollo social, cultural y económico, local y regional.';
        $capacidad5->save();

        //capacidad 6
        $capacidad6 = new Capacidades();
        $capacidad6->id_competencia = $id_competencia_3;
        $capacidad6->codigo = 'G3.02';
        $capacidad6->contenido = 'Propone alternativas que promuevan el desarrollo sostenible en el contexto nacional y global articuladas a actividades que preserven y fortalezcan la identidad cultural y mejoren las relaciones humanas frente a la naturaleza.';
        $capacidad6->save();

        $this->cursos($capacidad1->id, $capacidad2->id, $capacidad3->id, $capacidad4->id, $capacidad5->id, $capacidad6->id);
    }

    public function cursos($id_capacidad1, $id_capacidad2, $id_capacidad3, $id_capacidad4, $id_capacidad5, $id_capacidad6){
        
    }

}
