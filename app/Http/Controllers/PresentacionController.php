<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Presentacion;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class PresentacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la presentacion
        $data = Presentacion::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $presentacion = $data;
        }else{
            $presentacion = new Presentacion();
            $presentacion->id_programa_estudios = $programa_estudio->id;
            $presentacion->save();
        }

        return view('admin.pages.presentacion.index')->with(compact('presentacion', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $presentacion = Presentacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $presentacion->contenido = $request->contenido;
        $presentacion->save();

        return back()->with('mensaje', 'Presentación actualizada');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $presentacion = Presentacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.presentacion.reporte', compact('presentacion'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('presentacion.pdf');
        return $pdf->stream();
    }
}
