<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoCompetencias;
use App\Models\Competencias;
use App\Models\ProgramaEstudios;
use App\Models\Capacidades;
use App\Models\CursoDepartamento;
use App\Models\CursoRequisito;
use App\Models\MapaCurricular;
use App\Models\Sumilla;
use App\Models\CursosPlanEstudios;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class CompetenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $tipo_competencias = TipoCompetencias::all();
        return view('admin.pages.competencias.index')->with(compact('tipo_competencias'));
    }

    public function listaCompetencias($id_tipo){
        $tipo_competencia_id = decrypt($id_tipo);
        $user_id = auth()->user()->id;
        $tipo = TipoCompetencias::find($tipo_competencia_id);
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $competencias = Competencias::where('id_tipo_competencia', $tipo_competencia_id)
        ->where('id_programa_estudios', $programa_estudio->id)->get();

        return view('admin.pages.competencias.competencia')->with(compact('competencias','tipo','programa_estudio'));
    }

    public function store(Request $request){
        $competencia = Competencias::create($request->all());
        return back();
    }
    
    public function updateCompetencia($id_competencia, Request $request){
        $competencia = Competencias::find($id_competencia);
        $competencia->codigo = $request->codigo;
        $competencia->contenido = $request->contenido;
        $competencia->save();
        return back();
    }

    public function delete($id_competencia){
        $capacidades = Capacidades::where('id_competencia', $id_competencia)->get();
        if (isset($capacidades)) {
            foreach ($capacidades as $value) {
                $mapa = MapaCurricular::where('id_capacidad', $value->id)->get();

                foreach ($mapa as $key) {
                    $sumilla = Sumilla::where('id_curso', $key->id_curso_plan_estudios)->first();
                    $curso_departamento = CursoDepartamento::where('id_curso',$key->id_curso_plan_estudios)->get();
                    $curso_requisito = CursoRequisito::where('id_curso', $key->id_curso_plan_estudios)->get();
                    foreach ($curso_departamento as $item) {
                        $item->delete();
                    }
    
                    foreach ($curso_requisito as $item2) {
                        $item2->delete();
                    }

                    $sumilla->delete();
                   
    
                    $curso = CursosPlanEstudios::find($key->id_curso_plan_estudios);
                    $key->delete();
                    $curso->delete();
                   
                }
                $value->delete();
            }
        }
        $competencia = Competencias::find($id_competencia);
        $competencia->delete();

        return back();
    }


    //CAPACIDADES
    public function storeCapacidad(Request $request){
        $capacidad = Capacidades::create($request->all());
        return back();
    }

    public function deleteCapacidad($id_capacidad){
        $capacidad = Capacidades::find($id_capacidad);
        $capacidad->delete();
        return back();
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $competenciasGeneral = Competencias::where('id_programa_estudios', $programa_estudio->id)->where('id_tipo_competencia', 1)->get();
        $competenciasEspecifico = Competencias::where('id_programa_estudios', $programa_estudio->id)->where('id_tipo_competencia', 2)->get();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.competencias.reporte', compact('competenciasGeneral', 'competenciasEspecifico'))
                ->setPaper('a4', 'portrait');

       // return $pdf->download('competencias.pdf');
        return $pdf->stream();
    }
}
