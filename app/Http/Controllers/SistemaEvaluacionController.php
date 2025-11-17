<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\SistemaEvaluacion;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class SistemaEvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la presentacion
        $data = SistemaEvaluacion::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $sistema_evaluacion = $data;
        }else{
            $sistema_evaluacion = new SistemaEvaluacion();
            $sistema_evaluacion->id_programa_estudios = $programa_estudio->id;
            $sistema_evaluacion->save();
        }

        return view('admin.pages.sistema_evaluacion.index')->with(compact('sistema_evaluacion', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $sistema_evaluacion = SistemaEvaluacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $sistema_evaluacion->contenido = $request->contenido;
        $sistema_evaluacion->save();

        return back()->with('mensaje', 'Sistema de evaluación actualizada');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $sistema_evaluacion = SistemaEvaluacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.sistema_evaluacion.reporte', compact('sistema_evaluacion'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('presentacion.pdf');
        return $pdf->stream();
    }
}
