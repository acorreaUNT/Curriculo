<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Creditos;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class CreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la Credito
        $data = Creditos::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $credito = $data;
        }else{
            $credito = new Creditos();
            $credito->id_programa_estudios = $programa_estudio->id;
            $credito->save();
        }

        return view('admin.pages.creditos.index')->with(compact('credito', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $credito = Creditos::where('id_programa_estudios', $programa_estudio->id)->first();
        $credito->contenido = $request->contenido;
        $credito->save();

        return back()->with('mensaje', 'Créditos (Responsables) ha sido actualizada');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $credito = Creditos::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.creditos.reporte', compact('credito'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('credito.pdf');
        return $pdf->stream();
    }
}
