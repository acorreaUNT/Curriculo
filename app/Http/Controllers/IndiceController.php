<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Indice;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class IndiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la presentacion
        $data = Indice::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $indice = $data;
        }else{
            $indice = new Indice();
            $indice->id_programa_estudios = $programa_estudio->id;
            $indice->save();
        }

        return view('admin.pages.indice.index')->with(compact('indice', 'programa_estudio'));
    }

    public function update(Request $request){
        //dd($request->all());
        $indice = Indice::where('id_programa_estudios',$request->id_programa_estudios)->first();
        $indice->n_presentacion = $request->n_presentacion ;
        $indice->n_introduccion = $request->n_introduccion ;
        $indice->n_bases_generales = $request->n_bases_generales ;
        $indice->n_bases_normativas = $request->n_bases_normativas ;
        $indice->n_bases_institucionales = $request->n_bases_institucionales ;
        $indice->n_bases_teorica = $request->n_bases_teorica ;
        $indice->n_estudio_demanda = $request->n_estudio_demanda ;
        $indice->n_obj_educacionales = $request->n_obj_educacionales ;
        $indice->n_ejes_curriculares = $request->n_ejes_curriculares ;
        $indice->n_competencias = $request->n_competencias ;
        $indice->n_genericas = $request->n_genericas ;
        $indice->n_especificas = $request->n_especificas ;
        $indice->n_perfiles = $request->n_perfiles ;
        $indice->n_perfil_ingreso = $request->n_perfil_ingreso ;
        $indice->n_perfil_egreso = $request->n_perfil_egreso ;
        $indice->n_mapa_curricular = $request->n_mapa_curricular ;
        $indice->n_malla_curricular = $request->n_malla_curricular ;
        $indice->n_plan_estudios = $request->n_plan_estudios ;
        $indice->n_sumilla = $request->n_sumilla ;
        $indice->n_estrategias_ensenanza = $request->n_estrategias_ensenanza ;
        $indice->n_lineamientos = $request->n_lineamientos ;
        $indice->n_sistema_evaluacion = $request->n_sistema_evaluacion ;
        $indice->n_eval_aprendizaje = $request->n_eval_aprendizaje ;
        $indice->n_eval_logro = $request->n_eval_logro ;
        $indice->n_eval_curricular = $request->n_eval_curricular ;
        $indice->n_referencias = $request->n_referencias ;
        $indice->n_anexos = $request->n_anexos ;
        $indice->save();

        return back()->with('mensaje', 'Indice actualizado');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $indice = Indice::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.indice.reporte', compact('indice'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('presentacion.pdf');
        return $pdf->stream();
    }
}
