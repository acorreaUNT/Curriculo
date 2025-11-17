<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Caratula;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class CaratulaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la perfil
        $data = Caratula::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $caratula = $data;
        }else{
            $caratula = new Caratula();
            $caratula->id_programa_estudios = $programa_estudio->id;
            $caratula->color_letra  = '#FFFFFF';
            $caratula->color_fondo = '#5B61A1';
            $caratula->save();
        }

        return view('admin.pages.caratula.index')->with(compact('caratula', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $caratula = Caratula::where('id_programa_estudios', $programa_estudio->id)->first();
        $caratula->rcf = $request->rcf;
        $caratula->rcu = $request->rcu;
        $caratula->color_letra = $request->color_letra;
        $caratula->color_fondo = $request->color_fondo;
        $caratula->save();

        return back()->with('mensaje', 'Los datos de la carátula se actualizaron correctamente');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $caratula = Caratula::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.caratula.reporte', compact('caratula'))
                ->setPaper('A4', 'portrait');

        //return $pdf->download('caratula.pdf');
        return $pdf->stream('caratula.pdf', ['Attachment' => false]);
    }
}
