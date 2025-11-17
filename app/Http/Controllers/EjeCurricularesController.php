<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\EjeCurricular;
use Barryvdh\DomPDF\Facade as PDF;
use DB;


class EjeCurricularesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la perfil
        $data = EjeCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $eje_curricular = $data;
        }else{
            $eje_curricular = new EjeCurricular();
            $eje_curricular->id_programa_estudios = $programa_estudio->id;
            $eje_curricular->save();
        }

        return view('admin.pages.eje_curricular.index')->with(compact('eje_curricular', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $eje_curricular = EjeCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        $eje_curricular->responsabilidad_social = $request->responsabilidad_social;
        $eje_curricular->investigacion_formativa = $request->investigacion_formativa;
        $eje_curricular->idi = $request->idi;
        $eje_curricular->sostenibilidad_ambiental = $request->sostenibilidad_ambiental;
        $eje_curricular->etica = $request->etica;
        $eje_curricular->identidad = $request->identidad;
        $eje_curricular->multidisciplinaria = $request->multidisciplinaria;
        $eje_curricular->save();

        return back()->with('mensaje', 'Eje curricular fue actualizada correctamente');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $eje_curricular = EjeCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.eje_curricular.reporte', compact('eje_curricular'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('eje_curricular.pdf');
        return $pdf->stream();
    }
}
