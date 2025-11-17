<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Graduacion;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class GraduacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la Credito
        $data = Graduacion::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $graduacion = $data;
        }else{
            $graduacion = new Graduacion();
            $graduacion->id_programa_estudios = $programa_estudio->id;
            $graduacion->save();
        }

        return view('admin.pages.graduacion.index')->with(compact('graduacion', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $graduacion = Graduacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $graduacion->contenido = $request->contenido;
        $graduacion->save();

        return back()->with('mensaje', 'Requisitos de Graduación y Titulación ha sido actualizada');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $graduacion = Graduacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.graduacion.reporte', compact('graduacion'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('credito.pdf');
        return $pdf->stream();
    }
}
