<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEstudio;
use App\Models\ProgramaEstudios;
use App\Models\CursosPlanEstudios;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class PlanEstudioController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();

        return view('admin.pages.plan_estudios.index')->with(compact('plan_estudio'));
    }

    public function store(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = new PlanEstudio();
        $plan_estudio->id_programa_estudios = $programa_estudio->id;
        $plan_estudio->num_ciclos = $request->num_ciclos;
        $plan_estudio->save();

        return back();
    }

    public function eliminar(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $plan_estudio->num_ciclos = $plan_estudio->num_ciclos - 2;
        $plan_estudio->save();

        return back();
    }

    public function adicionar(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $plan_estudio->num_ciclos = $plan_estudio->num_ciclos + 2;
        $plan_estudio->save();

        return back();
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $cursos2 = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->get();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.plan_estudios.reporte', compact('plan_estudio', 'cursos2', 'programa_estudio'))
                ->setPaper('a4', 'landscape');

        //return $pdf->download('plan_estudios.pdf');
        return $pdf->stream();
    }
}
