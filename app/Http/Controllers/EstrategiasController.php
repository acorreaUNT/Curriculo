<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\EstrategiaEnsenanza;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class EstrategiasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la introduccion
        $data = EstrategiaEnsenanza::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $estrategia = $data;
        }else{
            $estrategia = new EstrategiaEnsenanza();
            $estrategia->id_programa_estudios = $programa_estudio->id;
            $estrategia->save();
        }

        return view('admin.pages.estrategia.index')->with(compact('estrategia', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $estrategia = EstrategiaEnsenanza::where('id_programa_estudios', $programa_estudio->id)->first();
        $estrategia->contenido = $request->contenido;
        $estrategia->save();

        return back()->with('mensaje', 'Las Estrategias de enseñanza fueron actualizadas');
    }

    
    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $estrategia = EstrategiaEnsenanza::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.estrategia.reporte', compact('estrategia'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('estrategia.pdf');
        return $pdf->stream();
    }
}
