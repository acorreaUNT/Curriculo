<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caratula;
use App\Models\ProgramaEstudios;
use App\Models\Presentacion;
use App\Models\Introduccion;
use App\Models\EstudioDemanda;
use App\Models\Perfil;
use App\Models\ObjetivoEducacional;
use App\Models\EstrategiaEnsenanza;
use App\Models\BaseGeneral;
use App\Models\Competencias;
use App\Models\Referencia;
use App\Models\Anexo;
use App\Models\PlanEstudio;
use App\Models\Contextualizacion;
use App\Models\Sumilla;
use App\Models\CursosPlanEstudios;
use App\Models\MallaCurricular;
use App\Models\Indice;
use App\Models\Creditos;
use App\Models\Graduacion;
use App\Models\TablaConvalidaciones;
use App\Models\DetalleTablaConvalidaciones;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();

        $caratula = Caratula::where('id_programa_estudios', $programa_estudio->id)->first();
        $presentacion = Presentacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $credito = Creditos::where('id_programa_estudios', $programa_estudio->id)->first();
        $graduacion = Graduacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $indice = Indice::where('id_programa_estudios', $programa_estudio->id)->first();
        
        $introduccion = Introduccion::where('id_programa_estudios', $programa_estudio->id)->first();
        $estudio_demanda = EstudioDemanda::where('id_programa_estudios', $programa_estudio->id)->first();
        $perfil = Perfil::where('id_programa_estudios', $programa_estudio->id)->first();
        $objetivo = ObjetivoEducacional::where('id_programa_estudios', $programa_estudio->id)->first();
        $estrategia = EstrategiaEnsenanza::where('id_programa_estudios', $programa_estudio->id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $competencias = Competencias::where('id_programa_estudios', $programa_estudio->id)->where('id_tipo_competencia', 2)->get();
        $referencia = Referencia::where('id_programa_estudios', $programa_estudio->id)->first();
        $anexo = Anexo::where('id_programa_estudios', $programa_estudio->id)->first();
        $malla = MallaCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        $contextualizacion = Contextualizacion::where('id_programa_estudios', $programa_estudio->id)->first();
        
        $tabla_convalidacion = TablaConvalidaciones::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($tabla_convalidacion)){
            $detalle = DetalleTablaConvalidaciones::where('id_tabla_convalidaciones', $tabla_convalidacion->id)->orderBy('ciclo','DESC')->get();
        }else{
            $detalle = [];
        }
        



        if(isset($plan_estudio)){
            $cursos = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->get();
        }else{
            $cursos = [];
        }
       //dd($cursos);
        if(isset($plan_estudio)){
            $sumillas = Sumilla::select('*')
                ->join('cursos_plan_estudios', 'sumillas.id_curso', '=', 'cursos_plan_estudios.id')
                ->where('cursos_plan_estudios.id_plan_estudio', $plan_estudio->id)
                ->get();
        }else{
            $sumillas = [];
        }

        return view('home')->with(compact('caratula', 'credito', 'graduacion' ,'contextualizacion', 'presentacion', 'introduccion', 'estudio_demanda', 'indice',
        'perfil', 'objetivo', 'estrategia', 'base_general', 'competencias', 'referencia', 'anexo', 'sumillas','cursos', 'malla','programa_estudio','tabla_convalidacion','detalle'));
    }
}
