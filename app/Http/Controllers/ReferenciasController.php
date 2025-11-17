<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Referencia;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class ReferenciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la referencia
        $data = Referencia::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $referencia = $data;
        }else{
            $referencia = new Referencia();
            $referencia->id_programa_estudios = $programa_estudio->id;
            $referencia->save();
        }

        return view('admin.pages.referencia.index')->with(compact('referencia', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $referencia = Referencia::where('id_programa_estudios', $programa_estudio->id)->first();
        $referencia->contenido = $request->contenido;
        $referencia->save();

        return back()->with('mensaje', 'Referencias actualizadas');
    }

    
    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $referencia = Referencia::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.referencia.reporte', compact('referencia'))
                ->setPaper('a4', 'portrait');

       // return $pdf->download('referencia.pdf');
        return $pdf->stream();
    }
}
