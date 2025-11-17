<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\TablaConvalidaciones;
use App\Models\DetalleTablaConvalidaciones;
use App\Models\CursosPlanEstudios;
use App\Models\PlanEstudio;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class TablaConvalidacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $cursos = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo','!=','EXTRACURRICULAR')->get();
        //buscamos la presentacion
        $data = TablaConvalidaciones::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $tabla_convalidacion = $data;

            $detalle = DetalleTablaConvalidaciones::where('id_tabla_convalidaciones', $tabla_convalidacion->id)->orderBy('ciclo','DESC')->get();
        }else{
            $tabla_convalidacion = new TablaConvalidaciones();
            $tabla_convalidacion->id_programa_estudios = $programa_estudio->id;
            $tabla_convalidacion->save();

            $detalle = DetalleTablaConvalidaciones::where('id_tabla_convalidaciones', $tabla_convalidacion->id)->orderBy('ciclo','DESC')->get();
        }

        return view('admin.pages.tabla_convalidacion.index')->with(compact('tabla_convalidacion', 'programa_estudio', 'detalle', 'cursos'));
    }

    public function store(Request $request){
        $detalle = new DetalleTablaConvalidaciones();
        $detalle->id_tabla_convalidaciones = $request->id_tabla_convalidacion;
        $detalle->ciclo = $request->ciclo;
        $detalle->credito = $request->creditos;
        $detalle->nombre_curso = $request->nombre_curso_2018;
        $detalle->id_curso_plan_estudios = $request->id_curso_2021;
        $detalle->save();

        return back()->with('mensaje', 'Asignación agregada');
    }

    public function deleteDetalle($id_tabla){
        $detalle = DetalleTablaConvalidaciones::find($id_tabla);
        $detalle->delete();

        return back()->with('mensaje', 'Asignación eliminada');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $tabla_convalidacion = TablaConvalidaciones::where('id_programa_estudios', $programa_estudio->id)->first();
        $detalle = DetalleTablaConvalidaciones::where('id_tabla_convalidaciones', $tabla_convalidacion->id)->orderBy('ciclo','DESC')->get();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.tabla_convalidacion.reporte', compact('tabla_convalidacion', 'detalle'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('tab$tabla_convalidacion.pdf');
        return $pdf->stream();
    }
}
