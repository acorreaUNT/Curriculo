<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoCompetencias;
use App\Models\Competencias;
use App\Models\ProgramaEstudios;
use App\Models\Capacidades;
use App\Models\CursosPlanEstudios;
use App\Models\MapaCurricular;
use App\Models\PlanEstudio;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use DB;

class MapaCurricularController extends Controller
{
    
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }

  
    
    public function index(){
        $tipo_competencias = TipoCompetencias::all();
        return view('admin.pages.mapa_curricular.index')->with(compact('tipo_competencias'));
    }

    public function mapaCurricular($id_tipo){
        $tipo_competencia_id = decrypt($id_tipo);
        $user_id = auth()->user()->id;
        $tipo = TipoCompetencias::find($tipo_competencia_id);
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $competencias = Competencias::where('id_tipo_competencia', $tipo_competencia_id)
        ->where('id_programa_estudios', $programa_estudio->id)->get();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $cursos = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->orderBy('ciclo','ASC')->get();
        $tcapacidades = Capacidades::select('capacidades.*')
                            ->join('competencias', 'capacidades.id_competencia', '=', 'competencias.id')
                            ->where('competencias.id_programa_estudios', $programa_estudio->id)
                            ->where('competencias.id_tipo_competencia', $tipo_competencia_id )
                            ->get();
        return view('admin.pages.mapa_curricular.mapa')
                ->with(compact('programa_estudio', 'competencias', 'tipo', 'cursos', 'tcapacidades'));
    }

    public function updateMapa(Request $request){
        //dd($request->all());
        $mapa_curricular = MapaCurricular::select('mapa_curriculars.*')
        ->join('capacidades', 'mapa_curriculars.id_capacidad', '=', 'capacidades.id')
        ->join('competencias', 'capacidades.id_competencia', '=', 'competencias.id')
        ->where('competencias.id_programa_estudios', $request->id_programa_estudio)
        ->where('competencias.id_tipo_competencia', $request->id_tipo_competencia )
        ->get();

        foreach ($mapa_curricular as $item) {
            $item->delete();
        }

        for ($i=0; $i < sizeof($request->relacion) ; $i++) { 
            //$posicion_coincidencia = strpos($request->relacion[$i], ',');
            $capacidad = stristr($request->relacion[$i], ',');
            $id_capacidad = substr($capacidad, 1); 
            $id_curso = stristr($request->relacion[$i], ',', true);

            $seleccion_mapa = new MapaCurricular();
            $seleccion_mapa->id_capacidad = $id_capacidad;
            $seleccion_mapa->id_curso_plan_estudios = $id_curso;
            $seleccion_mapa->save();
        }

        return back();
        
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $competenciasG = Competencias::where('id_tipo_competencia', 1)
        ->where('id_programa_estudios', $programa_estudio->id)->get();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $cursos = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->orderBy('ciclo','ASC')->get();
        $tcapacidadesG = Capacidades::select('capacidades.*')
                            ->join('competencias', 'capacidades.id_competencia', '=', 'competencias.id')
                            ->where('competencias.id_programa_estudios', $programa_estudio->id)
                            ->where('competencias.id_tipo_competencia', 1 )
                            ->get();
         $competenciasE = Competencias::where('id_tipo_competencia', 2)
        ->where('id_programa_estudios', $programa_estudio->id)->get();
        $tcapacidadesE = Capacidades::select('capacidades.*')
                            ->join('competencias', 'capacidades.id_competencia', '=', 'competencias.id')
                            ->where('competencias.id_programa_estudios', $programa_estudio->id)
                            ->where('competencias.id_tipo_competencia', 2 )
                            ->get();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.mapa_curricular.reporte', compact('competenciasG','tcapacidadesG','competenciasE','tcapacidadesE','cursos'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('presentacion.pdf');
        return $pdf->stream();
    }
}
