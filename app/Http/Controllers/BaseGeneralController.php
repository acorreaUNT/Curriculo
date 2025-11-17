<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\BaseGeneral;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class BaseGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function baseNormativa(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la perfil
        $data = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $base_general = $data;
        }else{
            $base_general = new BaseGeneral();
            $base_general->id_programa_estudios = $programa_estudio->id;
            $base_general->save();
        }

        return view('admin.pages.bases_generales.bases_normativas')->with(compact('base_general', 'programa_estudio'));
    }

    public function baseNormativaUpdate(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $base_general->bn_contenido = $request->bn_contenido;
        $base_general->save();

        return back()->with('mensaje', 'Base Normativa fue actualizada correctamente');
    }

    public function baseInstitucional(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la perfil
        $data = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $base_general = $data;
        }else{
            $base_general = new BaseGeneral();
            $base_general->id_programa_estudios = $programa_estudio->id;
            $base_general->save();
        }

        return view('admin.pages.bases_generales.bases_institucionales')->with(compact('base_general', 'programa_estudio'));
    }

    public function baseInstitucionalUpdate1(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($request->bi_fac_mision)){
            $base_general->bi_fac_mision = $request->bi_fac_mision;
        }
        if(isset($request->bi_fac_vision)){
            $base_general->bi_fac_vision = $request->bi_fac_vision;
        }
        
        $base_general->save();

        return back()->with('mensaje', 'Base Institucional fue actualizada correctamente');
    }

    public function baseInstitucionalUpdate2(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($request->bi_men_mision)){
            $base_general->bi_men_mision = $request->bi_men_mision;
        }
        if(isset($request->bi_men_vision)){
            $base_general->bi_men_vision = $request->bi_men_vision;
        }
        
        $base_general->save();

        return back()->with('mensaje', 'Base Institucional fue actualizada correctamente');
    }

    public function baseInstitucionalUpdate3(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $base_general->bi_principios_facultad = $request->bi_principios_facultad;
        $base_general->save();

        return back()->with('mensaje', 'Base Institucional fue actualizada correctamente');
    }

    public function baseConceptuales(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la perfil
        $data = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $base_general = $data;
        }else{
            $base_general = new BaseGeneral();
            $base_general->id_programa_estudios = $programa_estudio->id;
            $base_general->save();
        }

        return view('admin.pages.bases_generales.bases_conceptuales')->with(compact('base_general', 'programa_estudio'));
    }

    public function baseConceptualUpdate1(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $base_general->concepcion_humano = $request->concepcion_humano;
        $base_general->save();

        return back()->with('mensaje', 'Base Teórico Conceptual fue actualizada correctamente');
    }

    public function baseConceptualUpdate2(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $base_general->concepcion_episte = $request->concepcion_episte;
        $base_general->save();

        return back()->with('mensaje', 'Base Teórico Conceptual fue actualizada correctamente');
    }

    public function baseConceptualUpdate3(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $base_general->concepcion_curricular = $request->concepcion_curricular;
        $base_general->save();

        return back()->with('mensaje', 'Base Teórico Conceptual fue actualizada correctamente');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.bases_generales.reporte', compact('base_general'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('base_general.pdf');
        return $pdf->stream();
    }

}
