<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEstudio;
use App\Models\ProgramaEstudios;
use App\Models\CursosPlanEstudios;
use App\Models\CursoDepartamento;
use App\Models\CursoRequisito;
use App\Models\Sumilla;
use App\User;
use DB;

class CursosPlanEstudiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($encriptado){
        $ciclo = decrypt($encriptado);
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();

        return view('admin.pages.plan_estudios.cursos.index')->with(compact('ciclo', 'plan_estudio'));
    }

    public function getCursosXCiclo($ciclo, $plan_id){
        $cursos = CursosPlanEstudios::where('ciclo', $ciclo)->where('id_plan_estudio', $plan_id)->get();
        return response()->json($cursos);
    }

    public function getCursosRequisitoCiclo($plan){
        $cursos = DB::table('cursos_plan_estudios')->select('id', 'nombre as text')
        ->where('id_plan_estudio',$plan)->get();
        return response()->json($cursos);
    }

    public function getDepartamentoXCurso($id_curso){
        $departamento_cursos = CursoDepartamento::where('id_curso', $id_curso)->get();
        return response()->json($departamento_cursos);
    }

    public function store(Request $request){
        //dd($request->cursos[0]['tipo']);
        
        for ($i=0; $i < sizeof($request->cursos) ; $i++) { 
            //if($request->cursos[$i]['tipo'] !== 'GENERAL' && $request->cursos[$i]['tipo'] !== 'EXTRACURRICULAR' ){
                $curso = new CursosPlanEstudios();
                $curso->id_plan_estudio = $request->plan['id'];
                $curso->ciclo = $request->ciclo;
                $curso->nombre = $request->cursos[$i]['asignatura'];
                $curso->tipo = $request->cursos[$i]['tipo'];
                if($request->cursos[$i]['ht']>0 && $request->cursos[$i]['hp']>0){
                    $curso->naturaleza = 'Teórico / Práctico';
                }
                if($request->cursos[$i]['ht']== 0 && $request->cursos[$i]['hp']>0){
                    $curso->naturaleza = 'Práctico';
                }
                if($request->cursos[$i]['ht']>0 && $request->cursos[$i]['hp']== 0){
                    $curso->naturaleza = 'Teórico';
                }  
                $curso->ht = $request->cursos[$i]['ht'];
                $curso->hp = $request->cursos[$i]['hp'];
                $curso->h_semana = $request->cursos[$i]['total'];
                $curso->total_h = $request->cursos[$i]['total']*16;
                $curso->creditos = $request->cursos[$i]['creditos'];

                $curso->save();

                if(isset($request->cursos[$i]['requisitos'])){
                    for ($j=0; $j < sizeof($request->cursos[$i]['requisitos']) ; $j++) { 
                        $requisitos = new CursoRequisito();
                        $requisitos->id_curso = $curso->id;
                        $requisitos->id_requisito = $request->cursos[$i]['requisitos'][$j];
                        $requisitos->save();
                    }
                }

                if(isset($request->cursos[$i]['departamentos'])){
                    for ($k=0; $k < sizeof($request->cursos[$i]['departamentos']) ; $k++) { 
                        $departamentos = new CursoDepartamento();
                        $departamentos->id_curso = $curso->id;
                        $departamentos->id_departamento = $request->cursos[$i]['departamentos'][$k];
                        $departamentos->save();
                    }
                }
                
                $sumillas = new Sumilla();
                $sumillas->id_curso = $curso->id;
                $sumillas->save();

            }
        //}
        
        return response()->json(true);
    }
}
