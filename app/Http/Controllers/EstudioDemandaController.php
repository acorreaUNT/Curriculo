<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\EstudioDemanda;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class EstudioDemandaController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la perfil
        $data = EstudioDemanda::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $estudio_demanda = $data;
        }else{
            $estudio_demanda = new EstudioDemanda();
            $estudio_demanda->id_programa_estudios = $programa_estudio->id;
            $estudio_demanda->save();
        }

        return view('admin.pages.estudio_demanda.index')->with(compact('estudio_demanda', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $estudio_demanda = EstudioDemanda::where('id_programa_estudios', $programa_estudio->id)->first();
        $estudio_demanda->influencia_programa = $request->influencia_programa;
        $estudio_demanda->laboral_profesional = $request->laboral_profesional;
        $estudio_demanda->demanda_formativa = $request->demanda_formativa;
        $estudio_demanda->pertinencia_social = $request->pertinencia_social;
        $estudio_demanda->modalidades_estudio = $request->modalidades_estudio;
        $estudio_demanda->save();

        return back()->with('mensaje', 'El Estudio de la demanda social y el Mercado laboral se actualizó correctamente');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $estudio_demanda = EstudioDemanda::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.estudio_demanda.reporte', compact('estudio_demanda'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('estudio_demanda.pdf');
        return $pdf->stream();
    }
}
