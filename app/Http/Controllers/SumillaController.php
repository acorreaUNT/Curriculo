<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanEstudio;
use App\Models\ProgramaEstudios;
use App\Models\CursosPlanEstudios;
use App\Models\CursoDepartamento;
use App\Models\CursoRequisito;
use App\Models\Sumilla;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class SumillaController extends Controller
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
        if(isset($plan_estudio)){
            $sumillas = Sumilla::select('*')
                ->join('cursos_plan_estudios', 'sumillas.id_curso', '=', 'cursos_plan_estudios.id')
                ->where('cursos_plan_estudios.id_plan_estudio', $plan_estudio->id)
                ->get();
        }else{
            $sumillas = '';
        }
        
        return view('admin.pages.sumillas.index')->with(compact('plan_estudio', 'sumillas'));
    }

    public function edit($id_curso){
        $curso_id = decrypt($id_curso);
        $curso = CursosPlanEstudios::where('id', $curso_id)->first();
        $departamentos = CursoDepartamento::where('id_curso', $curso_id)->get();
        $requisitos = CursoRequisito::where('id_curso',$curso_id )->get();
        $sumilla = Sumilla::where('id_curso', $curso_id)->first();
        return view('admin.pages.sumillas.edit')->with(compact('curso','departamentos','requisitos', 'sumilla'));
    }

    public function update(Request $request){
       // dd($request->all());
        $sumilla = Sumilla::where('id_curso', $request->curso_id)->first();
        $sumilla->contenido_sumillas = $request->contenido_sumillas;
        
        $sumilla->perfil_docente = $request->perfil_docente;
        $sumilla->respo_social = $request->respo_social;
        $sumilla->inves_formativa = $request->inves_formativa;
        $sumilla->idi = $request->idi;
        $sumilla->sostenibilidad = $request->sostenibilidad;
        $sumilla->etica = $request->etica;
        $sumilla->identidad = $request->identidad;
        $sumilla->inter_multi = $request->inter_multi;

        if($sumilla->respo_social == 1){
            $texto1 = 'Responsabilidad social universitaria,';
        }else{
            $texto1 = '';
        }

        if($sumilla->inves_formativa == 1){
            $texto2 = ' Investigación formativa,';
        }else{
            $texto2 = '';
        }
        if($sumilla->idi == 1){
            $texto3 = ' I+D+i (investigación + desarrollo + innovación),';
        }else{
            $texto3 = '';
        }
        if($sumilla->sostenibilidad == 1){
            $texto4 = ' Sostenibilidad ambiental,';
        }else{
            $texto4 = '';
        }
        if($sumilla->etica == 1){
            $texto5 = ' Ética y ciudadanía,';
        }else{
            $texto5 = '';
        }
        if($sumilla->identidad == 1){
            $texto6 = ' Identidad, interculturalidad e inclusividad,';
        }else{
            $texto6 = '';
        }
        if($sumilla->inter_multi == 1){
            $texto7 = ' Interdisciplinariedad y multidisciplinariedad';
        }else{
            $texto7 = '';
        }
        $sumilla->ejes_transversales = $texto1.$texto2.$texto3.$texto4.$texto5.$texto6.$texto7;
        $sumilla->save();

        $curso = CursosPlanEstudios::find($request->curso_id);
        $curso->codigo = $request->codigo;
        $curso->save();
        
        return redirect()->route('sumillas');
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($plan_estudio)){
            $sumillas = Sumilla::select('*')
                ->join('cursos_plan_estudios', 'sumillas.id_curso', '=', 'cursos_plan_estudios.id')
                ->where('cursos_plan_estudios.id_plan_estudio', $plan_estudio->id)->orderBy('ciclo','ASC')
                ->get();
        }else{
            $sumillas = '';
        }
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.sumillas.reporte', compact('sumillas'))
                ->setPaper('a4', 'portrait');

        //return $pdf->download('sumillas.pdf');
        return $pdf->stream();
    }
}
