<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Introduccion;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class IntroduccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la introduccion
        $data = Introduccion::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $introduccion = $data;
        }else{
            $introduccion = new Introduccion();
            $introduccion->id_programa_estudios = $programa_estudio->id;
            $introduccion->save();
        }

        return view('admin.pages.introduccion.index')->with(compact('introduccion', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $introduccion = Introduccion::where('id_programa_estudios', $programa_estudio->id)->first();
        $introduccion->contenido = $request->contenido;
        $introduccion->save();

        return back()->with('mensaje', 'Introducción actualizada');
    }

    
    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $introduccion = Introduccion::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.introduccion.reporte', compact('introduccion'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('introduccion.pdf');
        return $pdf->stream();
    }
}
