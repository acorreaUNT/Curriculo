<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\ObjetivoEducacional;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class ObjetivosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la introduccion
        $data = ObjetivoEducacional::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $objetivo = $data;
        }else{
            $objetivo = new ObjetivoEducacional();
            $objetivo->id_programa_estudios = $programa_estudio->id;
            $objetivo->save();
        }

        return view('admin.pages.objetivo.index')->with(compact('objetivo', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $objetivo = ObjetivoEducacional::where('id_programa_estudios', $programa_estudio->id)->first();
        $objetivo->contenido = $request->contenido;
        $objetivo->save();

        return back()->with('mensaje', 'Objetivos actualizados correctamente');
    }

    
    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $objetivo = ObjetivoEducacional::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.objetivo.reporte', compact('objetivo'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('objetivo.pdf');
        return $pdf->stream();
    }
}
