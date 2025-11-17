<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Lineamiento;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class LineamientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la presentacion
        $data = Lineamiento::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $lineamiento = $data;
        }else{
            $lineamiento = new Lineamiento();
            $lineamiento->id_programa_estudios = $programa_estudio->id;
            $lineamiento->save();
        }

        return view('admin.pages.lineamientos.index')->with(compact('lineamiento', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $lineamiento = Lineamiento::where('id_programa_estudios', $programa_estudio->id)->first();
        $lineamiento->contenido = $request->contenido;
        $lineamiento->save();

        return back()->with('mensaje', 'Lineamiento actualizada');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $lineamiento = Lineamiento::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.lineamientos.reporte', compact('lineamiento'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('presentacion.pdf');
        return $pdf->stream();
    }
}
