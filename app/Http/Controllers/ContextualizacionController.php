<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Contextualizacion;
use Barryvdh\DomPDF\Facade as PDF;
use DB;


class ContextualizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la presentacion
        $data = Contextualizacion::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $contextualizacion = $data;
        }else{
            $contextualizacion = new Contextualizacion();
            $contextualizacion->id_programa_estudios = $programa_estudio->id;
            $contextualizacion->save();
        }

        return view('admin.pages.contextualizacion.index')->with(compact('contextualizacion', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $contextualizacion = Contextualizacion::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($request->sintesis)){
            $contextualizacion->sintesis = $request->sintesis;
        }
        if(isset($request->determinacion)){
            $contextualizacion->determinacion = $request->determinacion;
        }
        if(isset($request->desarrollo)){
            $contextualizacion->desarrollo = $request->desarrollo;
        }
        
        $contextualizacion->save();

        return back()->with('mensaje', 'Contextualización del Programa Profesional actualizada');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $contextualizacion = Contextualizacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.contextualizacion.reporte', compact('contextualizacion'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('presentacion.pdf');
        return $pdf->stream();
    }
}
