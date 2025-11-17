<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Perfil;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la perfil
        $data = Perfil::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $perfil = $data;
        }else{
            $perfil = new Perfil();
            $perfil->id_programa_estudios = $programa_estudio->id;
            $perfil->save();
        }

        return view('admin.pages.perfil.index')->with(compact('perfil', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $perfil = Perfil::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($request->ingreso)){
            $perfil->ingreso = $request->ingreso;
        }
        if(isset($request->egreso)){
            $perfil->egreso = $request->egreso;
        }
        if(isset($request->objetivos_programa)){
            $perfil->objetivos_programa = $request->objetivos_programa;
        }
        if(isset($request->objetivos_educacionales)){
            $perfil->objetivos_educacionales = $request->objetivos_educacionales;
        }

        $perfil->save();

        return back()->with('mensaje', 'Perfil actualizado correctamente');
    }

    
    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $perfil = Perfil::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.perfil.reporte', compact('perfil'))
                ->setPaper('a4', 'portrait');

       // return $pdf->download('perfil.pdf');
        return $pdf->stream();
    }
}
