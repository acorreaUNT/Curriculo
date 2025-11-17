<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\MallaCurricular;
use App\Models\PlanEstudio;
use App\Models\CursosPlanEstudios;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Log;

class MallaCurricularController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $cursos2 = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo','!=','EXTRACURRICULAR')->get();
        //buscamos la anexo
        $data = MallaCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $malla = $data;
            
        }else{
            $malla = new MallaCurricular();
            $malla->id_programa_estudios = $programa_estudio->id;
            $malla->save();
        }

        return view('admin.pages.malla.index')->with(compact('malla', 'programa_estudio', 'plan_estudio','cursos2'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $malla = MallaCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        
        $image_path = public_path().'/mallas/'.$malla->malla;

        if ($request->file('malla')) {
            if (!is_null($malla->malla)) {
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            
            $file = $request->file('malla');
            $name = 'malla_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/mallas/';
            $file->move($path, $name);
    
            $malla->malla = $name;
        }
        $malla->save();

        return back()->with('mensaje', 'Archivo de Malla Curricular actualizado correctamente');
    }

    
    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $malla = MallaCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $cursos2 = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo','!=','EXTRACURRICULAR')->get();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.malla.reporte', compact('malla','plan_estudio','cursos2'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('malla.pdf');
        return $pdf->stream();
    }
}
