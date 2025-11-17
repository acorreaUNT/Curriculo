<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoCompetencias;
use App\Models\Competencias;
use App\Models\ProgramaEstudios;
use App\Models\Capacidades;
use App\Models\MapaCurricular;
use App\Models\CursosPlanEstudios;
use App\Models\PlanEstudio;
use App\Models\CursoRequisito;
use App\Models\CursoDepartamento;
use App\Models\Sumilla;
use App\User;
use DB;

class ArticulacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id_tipo){
        $tipo_competencia_id = decrypt($id_tipo);
        $user = auth()->user();
        $tipo = TipoCompetencias::find($tipo_competencia_id);
        $programa_estudio = ProgramaEstudios::where('id_user', $user->id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();

        $competencias = Competencias::where('id_programa_estudios', $programa_estudio->id)->where('id_tipo_competencia', $tipo_competencia_id)->get();
        return view('admin.pages.competencias.articulacion.index')->with(compact('competencias','plan_estudio','tipo','programa_estudio'));
    }

    public function getCursosCapacidad($id_capacidad){
        $cursos = MapaCurricular::where('id_capacidad',$id_capacidad )->get();
        $cursos = $cursos->load('cursosPlan');
        return response()->json($cursos);
    }

    public function getCursosMapaExistentes($id_plan_estudio){
        $cursos = CursosPlanEstudios::where('id_plan_estudio',$id_plan_estudio )->orderBy('creditos','DESC')->get();
        return response()->json($cursos);
    }

    public function storeArticulacion(Request $request){
        $nombre_masc = mb_strtoupper($request->curso['nombre_asignatura'], 'utf-8');
        $buscar_curso = CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('nombre', $nombre_masc)->first();
        $buscar_capacidad = Capacidades::find($request->capacidad_id);
        $plan_estudio = PlanEstudio::find($request->plan_estudio_id);
        $programa_estudio = ProgramaEstudios::find($plan_estudio->id_programa_estudios);

        //lista de cursos del ciclo

        $obt_electivo = count(CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('tipo','!=','GENERAL')->where('estado','electivo')->get());
            if($obt_electivo>0){
                if($request->curso['estado']=='electivo'){
                    $cant_electivo = 0 ;
                }else{
                    $cant_electivo = 1 ;
                }
               
            }else{
                $cant_electivo = 0;
            }
    

        $cant_general = count(CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('tipo','GENERAL')->where('estado',null)->get());

        $cant_obligatoria = count(CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('estado','obligatoria')->get());

      

        $cantidad_curso =  $cant_general +  $cant_electivo + $cant_obligatoria;

           

        $creditos_generales = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('estado',null)->sum('creditos');
        $creditos_especialidad = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('tipo','ESPECIALIDAD')->sum('creditos');
        $creditos_especificos =  CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('tipo','ESPECÍFICO')->sum('creditos');
        $cantidad_creditaje = $creditos_generales + $creditos_especificos + $creditos_especialidad;


        //Buscamos si es que hubiese un credito electivo en el ciclo, si es que hay como coincide el creditaje entre electivos, tomamos el primero
        $cursos_electivos = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'electivo')->get();

        if($request->curso['estado'] == 'electivo'){
            if(count($cursos_electivos)>0){
                $cursos_electivos_suma_creditaje = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'electivo')->sum('creditos');

                $credito_electivo = $cursos_electivos_suma_creditaje;
            }else{
                $credito_electivo = 0;
            }    
        }

        if($request->curso['estado'] == 'obligatoria'){
            if(count($cursos_electivos)>1){
                $cursos_electivos_suma_creditaje = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio',      $request->plan_estudio_id)->where('estado', 'electivo')->sum('creditos');

                $credito_electivo = $cursos_electivos_suma_creditaje-$cursos_electivos[0]->creditos;
            }else{
                $credito_electivo = 0;
            }    
        }
        //hasta aca se agrego
      
        //esto tambien se ha cambiado
        $creditaje_cursos_generales = CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('estado', null)->sum('creditos');
        $creditaje_cursos_generales_electivo = CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'electivo/general')->sum('creditos');
        $creditaje_cursos_obligatorio = CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'obligatoria')->sum('creditos');
        $creditaje_cursos_electivos = CursosPlanEstudios::distinct()->where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'electivo')->sum('creditos');
       
        $cantidad_creditaje_total = $creditaje_cursos_generales + $creditaje_cursos_obligatorio + $creditaje_cursos_electivos + $creditaje_cursos_generales_electivo;

        
        //hasta aca


        if(isset($buscar_curso)){
            return response()->json(false);
        }else{
            if ($programa_estudio->num_ciclos == 10) {
                if($cantidad_curso>=7 || $request->curso['creditos']+$cantidad_creditaje-$credito_electivo>23 || $cantidad_creditaje_total>220){
                    //dd($cantidad_curso);
                    return response()->json("2");
                }else{
                    //dd($cantidad_curso);
                    $curso = new CursosPlanEstudios();
                    $curso->id_plan_estudio = $request->plan_estudio_id;
                    $curso->nombre = $nombre_masc;
                    $curso->ciclo = $request->curso['ciclo'];
                    $curso->tipo = $request->curso['tipo'];
                    $curso->estado = $request->curso['estado'];
                    if($request->curso['ht']>0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Teórico / Práctico';
                    }
                    if($request->curso['ht'] == 0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Práctico';
                    }
                    if($request->curso['ht']>0 && $request->curso['hp']== 0){
                        $curso->naturaleza = 'Teórico';
                    }  
                    $curso->ht = $request->curso['ht'];
                    $curso->hp = $request->curso['hp'];
                    $curso->h_semana = $request->curso['total'];
                    $curso->total_h = $request->curso['total']*16;
                    $curso->codigo_capacitaciones = $buscar_capacidad->codigo;
                    $curso->creditos = $request->curso['creditos'];

                   // $curso->orden = 3;
                   
                   $c_general = count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('estado', null)->get());
                   $c_especifico =  count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('tipo', 'ESPECÍFICO')->get());;
                   $c_especialidad = count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('tipo', 'ESPECIALIDAD')->get());;

                    $cantidad_curso =  $c_general + $c_especifico + $c_especialidad;
        
                    if ($request->curso['ciclo'] == 'I') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 0';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 0';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 0';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 0';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 0';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 0';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 0';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 0';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 0';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 0';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 0';
                        }
                        
                    }
                    if ($request->curso['ciclo'] == 'II') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -140';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -140';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -140';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -140';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -140';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -140';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -140';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -140';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -140';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -140';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -140';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'III') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -280';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -280';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -280';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -280';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -280';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -280';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -280';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -280';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -280';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -280';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -280';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -420';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -420';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -420';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -420';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -420';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -420';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -420';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -420';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -420';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -420';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -420';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'V') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -560';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -560';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -560';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -560';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -560';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -560';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -560';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -560';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -560';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -560';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -560';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -700';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -700';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -700';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -700';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -700';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -700';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -700';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -700';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -700';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -700';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -700';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -840';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -840';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -840';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -840';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -840';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -840';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -840';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -840';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -840';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -840';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -840';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -980';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -980';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -980';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -980';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -980';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -980';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -980';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -980';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -980';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -980';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -980';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IX') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 1260';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 1260';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 1260';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 1260';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 1260';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 1260';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 1260';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 1260';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 1260';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 1260';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 1260';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'X') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 -1400';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 -1400';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 -1400';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 -1400';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 -1400';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 -1400';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 -1400';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1400';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 -1400';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 -1400';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 -1400';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 1540';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 1540';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 1540';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 1540';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 1540';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 1540';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 1540';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 1540';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 1540';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 1540';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 1540';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '0 1680';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '140 1680';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '280 1680';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '420 1680';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '560 1680';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '700 1680';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '840 1680';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 1680';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1120 1680';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1260 1680';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1400 1680';
                        }
                    }
                    
                    
                    if ($request->curso['tipo'] == 'GENERAL') {
                        $curso->color = '#5FC341';
                    }
                    if ($request->curso['tipo'] == 'ESPECIALIDAD') {
                        $curso->color = '#41BCC3';
                    }
                    if ($request->curso['tipo'] == 'ESPECÍFICO') {
                        $curso->color = '#F76725';
                    }
        
                    $curso->save();
        
                    if(isset($request->curso['requisitos'])){
                        for ($j=0; $j < sizeof($request->curso['requisitos']) ; $j++) { 
                            $requisitos = new CursoRequisito();
                            $requisitos->id_curso = $curso->id;
                            $requisitos->id_requisito = $request->curso['requisitos'][$j];
                            $requisitos->save();
                        }
                    }
        
                    if(isset($request->curso['departamentos'])){
                        for ($k=0; $k < sizeof($request->curso['departamentos']) ; $k++) { 
                            $departamentos = new CursoDepartamento();
                            $departamentos->id_curso = $curso->id;
                            $departamentos->id_departamento = $request->curso['departamentos'][$k];
                            $departamentos->save();
                        }
                    }
                    
                    if ($curso->tipo == 'GENERAL') {
                        $area = 'Estudios Generales';
                    }
                    if ($curso->tipo == 'ESPECÍFICO') {
                        $area = 'Estudios Específicos';
                    }
                    if ($curso->tipo == 'ESPECIALIDAD') {
                        $area = 'Estudios de Especialidad';
                    }
    
                    $sumillas = new Sumilla();
                    $sumillas->id_curso = $curso->id;
                    $sumillas->contenido_sumillas = 'La asignatura de '.$curso->nombre. ' pertenece al área de '.$area. ', es de naturaleza '. $curso->naturaleza.' y de carácter '.$curso->estado.' , tiene como propósito que el estudiante '.$buscar_capacidad->contenido.'. Se trabajan los siguientes bloques temáticos: a).... b).... c).... d)..... . Estrategias de enseñanza - aprendizaje básicas: ....';
                    //$sumillas->ejes_transversales = '';
                    $sumillas->save();
                  
                    $mapa = new MapaCurricular();
                    $mapa->id_capacidad = $request->capacidad_id;
                    $mapa->id_curso_plan_estudios = $curso->id;
                    $mapa->save();
        
                    return response()->json(true);
                }
            }
            if ($programa_estudio->num_ciclos == 12) {
                if($cantidad_curso>=7 || $request->curso['creditos']+$cantidad_creditaje-$credito_electivo>23 || $cantidad_creditaje_total>264){
                    return response()->json("2");
                }else{
                    $curso = new CursosPlanEstudios();
                    $curso->id_plan_estudio = $request->plan_estudio_id;
                    $curso->nombre = $nombre_masc;
                    $curso->ciclo = $request->curso['ciclo'];
                    $curso->tipo = $request->curso['tipo'];
                    $curso->estado = $request->curso['estado'];
                    if($request->curso['ht']>0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Teórico / Práctico';
                    }
                    if($request->curso['ht'] == 0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Práctico';
                    }
                    if($request->curso['ht']>0 && $request->curso['hp']== 0){
                        $curso->naturaleza = 'Teórico';
                    }  
                    $curso->ht = $request->curso['ht'];
                    $curso->hp = $request->curso['hp'];
                    $curso->h_semana = $request->curso['total'];
                    $curso->total_h = $request->curso['total']*16;
                    $curso->codigo_capacitaciones = $buscar_capacidad->codigo;
                    $curso->creditos = $request->curso['creditos'];
                    //$curso->orden = 3;
                    $cantidad_curso = count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('tipo','!=','EXTRACURRICULAR')->get());
        
                    if ($request->curso['ciclo'] == 'I') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 0';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 0';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 0';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 0';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 0';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 0';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 0';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 0';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 0';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 0';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 0';
                        }
                        
                    }
                    if ($request->curso['ciclo'] == 'II') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -140';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -140';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -140';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -140';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -140';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -140';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -140';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -140';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -140';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -140';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -140';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'III') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -260';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -260';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -260';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -260';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -260';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -260';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -260';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -260';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -260';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -260';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -260';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -380';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -380';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -380';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -380';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -380';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -380';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -380';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -380';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -380';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -380';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -380';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'V') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -500';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -500';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -500';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -500';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -500';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -500';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -500';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -500';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -500';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -500';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -500';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -620';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -620';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -620';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -620';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -620';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -620';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -620';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -620';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -620';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -620';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -620';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -740';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -740';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -740';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -740';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -740';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -740';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -740';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -740';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -740';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -740';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -740';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -860';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -860';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -860';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -860';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -860';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -860';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -860';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -860';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -860';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -860';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -860';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IX') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -980';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -980';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -980';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -980';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -980';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -980';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -980';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -980';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -980';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -980';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -980';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'X') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1100';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1100';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1100';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1100';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1100';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1100';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1100';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1100';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1100';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1100';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1100';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1220';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1220';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1220';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1220';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1220';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1220';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1220';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1220';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1220';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1220';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1220';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1340';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1340';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1340';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1340';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1340';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1340';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1340';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1340';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1340';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1340';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1340';
                        }
                    }
                    
                    
                    if ($request->curso['tipo'] == 'GENERAL') {
                        $curso->color = '#5FC341';
                    }
                    if ($request->curso['tipo'] == 'ESPECIALIDAD') {
                        $curso->color = '#41BCC3';
                    }
                    if ($request->curso['tipo'] == 'ESPECÍFICO') {
                        $curso->color = '#F76725';
                    }
        
                    $curso->save();
        
                    if(isset($request->curso['requisitos'])){
                        for ($j=0; $j < sizeof($request->curso['requisitos']) ; $j++) { 
                            $requisitos = new CursoRequisito();
                            $requisitos->id_curso = $curso->id;
                            $requisitos->id_requisito = $request->curso['requisitos'][$j];
                            $requisitos->save();
                        }
                    }
        
                    if(isset($request->curso['departamentos'])){
                        for ($k=0; $k < sizeof($request->curso['departamentos']) ; $k++) { 
                            $departamentos = new CursoDepartamento();
                            $departamentos->id_curso = $curso->id;
                            $departamentos->id_departamento = $request->curso['departamentos'][$k];
                            $departamentos->save();
                        }
                    }
                    
                    if ($curso->tipo == 'GENERAL') {
                        $area = 'Estudios Generales';
                    }
                    if ($curso->tipo == 'ESPECÍFICO') {
                        $area = 'Estudios Específicos';
                    }
                    if ($curso->tipo == 'ESPECIALIDAD') {
                        $area = 'Estudios de Especialidad';
                    }
    
                    $sumillas = new Sumilla();
                    $sumillas->id_curso = $curso->id;
                    $sumillas->contenido_sumillas = 'La asignatura de '.$curso->nombre. ' pertenece al área de '.$area. ', es de naturaleza '. $curso->naturaleza.' y de carácter '.$curso->estado.' , tiene como propósito que el estudiante '.$buscar_capacidad->contenido.'. Se trabajan los siguientes bloques temáticos: a).... b).... c).... d)..... . Estrategias de enseñanza - aprendizaje básicas: ....';
                    //$sumillas->ejes_transversales = '';
                    $sumillas->save();
                  
                    $mapa = new MapaCurricular();
                    $mapa->id_capacidad = $request->capacidad_id;
                    $mapa->id_curso_plan_estudios = $curso->id;
                    $mapa->save();
        
                    return response()->json(true);
                }
            }
            if ($programa_estudio->num_ciclos == 14) {
                if($cantidad_curso>=7 || $request->curso['creditos']+$cantidad_creditaje-$credito_electivo>23 || $cantidad_creditaje_total>308){
                    return response()->json("2");
                }else{
                    $curso = new CursosPlanEstudios();
                    $curso->id_plan_estudio = $request->plan_estudio_id;
                    $curso->nombre = $nombre_masc;
                    $curso->ciclo = $request->curso['ciclo'];
                    $curso->tipo = $request->curso['tipo'];
                    $curso->estado = $request->curso['estado'];
                    if($request->curso['ht']>0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Teórico / Práctico';
                    }
                    if($request->curso['ht'] == 0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Práctico';
                    }
                    if($request->curso['ht']>0 && $request->curso['hp']== 0){
                        $curso->naturaleza = 'Teórico';
                    }  
                    $curso->ht = $request->curso['ht'];
                    $curso->hp = $request->curso['hp'];
                    $curso->h_semana = $request->curso['total'];
                    $curso->total_h = $request->curso['total']*16;
                    $curso->codigo_capacitaciones = $buscar_capacidad->codigo;
                    $curso->creditos = $request->curso['creditos'];
                    //$curso->orden = 3;
                    $cantidad_curso = count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('tipo','!=','EXTRACURRICULAR')->get());
        
                    if ($request->curso['ciclo'] == 'I') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 0';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 0';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 0';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 0';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 0';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 0';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 0';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 0';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 0';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 0';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 0';
                        }
                        
                    }
                    if ($request->curso['ciclo'] == 'II') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -140';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -140';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -140';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -140';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -140';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -140';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -140';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -140';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -140';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -140';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -140';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'III') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -260';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -260';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -260';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -260';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -260';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -260';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -260';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -260';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -260';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -260';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -260';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -380';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -380';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -380';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -380';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -380';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -380';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -380';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -380';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -380';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -380';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -380';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'V') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -500';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -500';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -500';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -500';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -500';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -500';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -500';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -500';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -500';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -500';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -500';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -620';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -620';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -620';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -620';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -620';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -620';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -620';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -620';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -620';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -620';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -620';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -740';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -740';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -740';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -740';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -740';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -740';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -740';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -740';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -740';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -740';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -740';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -860';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -860';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -860';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -860';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -860';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -860';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -860';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -860';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -860';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -860';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -860';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IX') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -980';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -980';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -980';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -980';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -980';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -980';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -980';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -980';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -980';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -980';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -980';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'X') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1100';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1100';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1100';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1100';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1100';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1100';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1100';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1100';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1100';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1100';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1100';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1220';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1220';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1220';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1220';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1220';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1220';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1220';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1220';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1220';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1220';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1220';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1340';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1340';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1340';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1340';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1340';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1340';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1340';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1340';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1340';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1340';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1340';
                        }
                    }

                    if ($request->curso['ciclo'] == 'XIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1460';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1460';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1460';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1460';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1460';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1460';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1460';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1460';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1460';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1460';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1460';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XIV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1580';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1580';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1580';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1580';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1580';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1580';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1580';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1580';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1580';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1580';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1580';
                        }
                    }
                    
                    
                    if ($request->curso['tipo'] == 'GENERAL') {
                        $curso->color = '#5FC341';
                    }
                    if ($request->curso['tipo'] == 'ESPECIALIDAD') {
                        $curso->color = '#41BCC3';
                    }
                    if ($request->curso['tipo'] == 'ESPECÍFICO') {
                        $curso->color = '#F76725';
                    }
        
                    $curso->save();
        
                    if(isset($request->curso['requisitos'])){
                        for ($j=0; $j < sizeof($request->curso['requisitos']) ; $j++) { 
                            $requisitos = new CursoRequisito();
                            $requisitos->id_curso = $curso->id;
                            $requisitos->id_requisito = $request->curso['requisitos'][$j];
                            $requisitos->save();
                        }
                    }
        
                    if(isset($request->curso['departamentos'])){
                        for ($k=0; $k < sizeof($request->curso['departamentos']) ; $k++) { 
                            $departamentos = new CursoDepartamento();
                            $departamentos->id_curso = $curso->id;
                            $departamentos->id_departamento = $request->curso['departamentos'][$k];
                            $departamentos->save();
                        }
                    }
                    
                    if ($curso->tipo == 'GENERAL') {
                        $area = 'Estudios Generales';
                    }
                    if ($curso->tipo == 'ESPECÍFICO') {
                        $area = 'Estudios Específicos';
                    }
                    if ($curso->tipo == 'ESPECIALIDAD') {
                        $area = 'Estudios de Especialidad';
                    }
    
                    $sumillas = new Sumilla();
                    $sumillas->id_curso = $curso->id;
                    $sumillas->contenido_sumillas = 'La asignatura de '.$curso->nombre. ' pertenece al área de '.$area. ', es de naturaleza '. $curso->naturaleza.' y de carácter '.$curso->estado.' , tiene como propósito que el estudiante '.$buscar_capacidad->contenido.'. Se trabajan los siguientes bloques temáticos: a).... b).... c).... d)..... . Estrategias de enseñanza - aprendizaje básicas: ....';
                    //$sumillas->ejes_transversales = '';
                    $sumillas->save();
                  
                    $mapa = new MapaCurricular();
                    $mapa->id_capacidad = $request->capacidad_id;
                    $mapa->id_curso_plan_estudios = $curso->id;
                    $mapa->save();
        
                    return response()->json(true);
                }
            }
                       
        }
    }

    public function updateArticulacion(Request $request){
        $nombre_masc = mb_strtoupper($request->curso['nombre_asignatura'], 'utf-8');
        $buscar_curso = CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('nombre', $nombre_masc)
        ->where('id','!==', $request->curso['id'])->first();
        $buscar_capacidad = Capacidades::find($request->capacidad_id);
        $plan_estudio = PlanEstudio::find($request->plan_estudio_id);
        $programa_estudio = ProgramaEstudios::find($plan_estudio->id_programa_estudios);

 
 
        //lista de cursos del ciclo
             $obt_extracurricular = count(CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('tipo','EXTRACURRICULAR')->get());
             if($obt_extracurricular>0){
                 $cant_extracurricular = 0 ;
             }else{
                 $cant_extracurricular = 0;
             }
 
         $obt_electivo = count(CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('estado','electivo')->get());
             if($obt_electivo>0){
                 if($request->curso['estado']=='electivo'){
                     $cant_electivo = 0 ;
                 }else{
                     $cant_electivo = 1 ;
                 }
                
             }else{
                 $cant_electivo = 0;
             }
     
 
         $cant_general = count(CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('tipo','GENERAL')->get());
 
         $cant_obligatoria = count(CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('estado','obligatoria')->get());
 
       
 
         $cantidad_curso = $cant_extracurricular + $cant_general + $cant_electivo + $cant_obligatoria;
 
            
 
         $cantidad_creditaje = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->sum('creditos');
 
 
         //Buscamos si es que hubiese un credito electivo en el ciclo, si es que hay como coincide el creditaje entre electivos, tomamos el primero
         $cursos_electivos = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'electivo')->get();
 
         if($request->curso['estado'] == 'electivo'){
             if(count($cursos_electivos)>0){
                 $cursos_electivos_suma_creditaje = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio',      $request->plan_estudio_id)->where('estado', 'electivo')->sum('creditos');
 
                 $credito_electivo = $cursos_electivos_suma_creditaje;
             }else{
                 $credito_electivo = 0;
             }    
         }
 
         if($request->curso['estado'] == 'obligatoria'){
             if(count($cursos_electivos)>1){
                 $cursos_electivos_suma_creditaje = CursosPlanEstudios::where('ciclo',$request->curso['ciclo'])->where('id_plan_estudio',      $request->plan_estudio_id)->where('estado', 'electivo')->sum('creditos');
 
                 $credito_electivo = $cursos_electivos_suma_creditaje-$cursos_electivos[0]->creditos;
             }else{
                 $credito_electivo = 0;
             }    
         }
         //hasta aca se agrego
       
         //esto tambien se ha cambiado
         $creditaje_cursos_generales = CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('tipo', 'GENERAL')->sum('creditos');
         $creditaje_cursos_obligatorio = CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'obligatoria')->sum('creditos');
         $creditaje_cursos_electivos = CursosPlanEstudios::distinct()->where('id_plan_estudio', $request->plan_estudio_id)->where('estado', 'electivo')->sum('creditos');
        
         $cantidad_creditaje_total = $creditaje_cursos_generales + $creditaje_cursos_obligatorio + $creditaje_cursos_electivos;
         ///
        

        if(isset($buscar_curso)){
            return response()->json(false);
        }else{
            //Curso Existente
            $cursoEditar = CursosPlanEstudios::find($request->curso['id']);
            $creditaje_verdadero = $cantidad_creditaje - $cursoEditar->creditos;

            if ($programa_estudio->num_ciclos == 10) {
                if($cantidad_curso>7 || $request->curso['creditos']+$creditaje_verdadero-$credito_electivo>23 || $cantidad_creditaje_total>220){
                    return response()->json("2");
                }else{
                    $curso = CursosPlanEstudios::find($request->curso['id']);
                    $curso->nombre = $nombre_masc;
                    $curso->ciclo = $request->curso['ciclo'];
                    $curso->tipo = $request->curso['tipo'];
                    $curso->estado = $request->curso['estado'];
                    if($request->curso['ht']>0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Teórico / Práctico';
                    }
                    if($request->curso['ht'] == 0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Práctico';
                    }
                    if($request->curso['ht']>0 && $request->curso['hp']== 0){
                        $curso->naturaleza = 'Teórico';
                    }  
                    $curso->ht = $request->curso['ht'];
                    $curso->hp = $request->curso['hp'];
                    $curso->h_semana = $request->curso['total'];
                    $curso->total_h = $request->curso['total']*16;
                    $curso->codigo_capacitaciones = $buscar_capacidad->codigo;
                    $curso->creditos = $request->curso['creditos'];
                    
                    $cantidad_curso = count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('tipo','!=','EXTRACURRICULAR')->get());
        
                    
                    if ($request->curso['ciclo'] == 'I') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 0';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 0';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 0';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 0';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 0';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 0';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 0';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 0';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 0';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 0';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 0';
                        }
                        
                    }
                    if ($request->curso['ciclo'] == 'II') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -140';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -140';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -140';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -140';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -140';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -140';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -140';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -140';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -140';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -140';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -140';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'III') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -260';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -260';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -260';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -260';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -260';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -260';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -260';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -260';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -260';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -260';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -260';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -380';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -380';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -380';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -380';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -380';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -380';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -380';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -380';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -380';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -380';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -380';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'V') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -500';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -500';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -500';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -500';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -500';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -500';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -500';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -500';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -500';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -500';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -500';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -620';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -620';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -620';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -620';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -620';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -620';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -620';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -620';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -620';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -620';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -620';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -740';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -740';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -740';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -740';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -740';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -740';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -740';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -740';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -740';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -740';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -740';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -860';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -860';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -860';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -860';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -860';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -860';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -860';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -860';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -860';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -860';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -860';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IX') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -980';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -980';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -980';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -980';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -980';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -980';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -980';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -980';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -980';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -980';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -980';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'X') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1100';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1100';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1100';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1100';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1100';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1100';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1100';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1100';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1100';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1100';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1100';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1220';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1220';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1220';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1220';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1220';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1220';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1220';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1220';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1220';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1220';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1220';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1340';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1340';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1340';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1340';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1340';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1340';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1340';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1340';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1340';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1340';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1340';
                        }
                    }
                    
                    
                    if ($request->curso['tipo'] == 'GENERAL') {
                        $curso->color = '#5FC341';
                    }
                    if ($request->curso['tipo'] == 'ESPECIALIDAD') {
                        $curso->color = '#41BCC3';
                    }
                    if ($request->curso['tipo'] == 'ESPECÍFICO') {
                        $curso->color = '#F76725';
                    }
        
                    $curso->save();
    
                    //eliminamos requisitos
                    $requisitos_curso = CursoRequisito::where('id_curso', $curso->id)->get();
    
                    if(count($requisitos_curso)>0){
                        foreach ($requisitos_curso as $item) {
                            $item->delete();
                        }
                    }
    
                    //eliminamos departamento
                    $departamento_curso = CursoDepartamento::where('id_curso', $curso->id)->get();
    
                    if(count($departamento_curso)>0){
                        foreach ($departamento_curso as $item) {
                            $item->delete();
                        }
                    }
    
        
                    if(isset($request->curso['requisitos'])){
                        for ($j=0; $j < sizeof($request->curso['requisitos']) ; $j++) { 
                            $requisitos = new CursoRequisito();
                            $requisitos->id_curso = $curso->id;
                            $requisitos->id_requisito = $request->curso['requisitos'][$j];
                            $requisitos->save();
                        }
                    }
        
                    if(isset($request->curso['departamentos'])){
                        for ($k=0; $k < sizeof($request->curso['departamentos']) ; $k++) { 
                            $departamentos = new CursoDepartamento();
                            $departamentos->id_curso = $curso->id;
                            $departamentos->id_departamento = $request->curso['departamentos'][$k];
                            $departamentos->save();
                        }
                    }             
    
                    if ($curso->tipo == 'GENERAL') {
                        $area = 'Estudios Generales';
                    }
                    if ($curso->tipo == 'ESPECÍFICO') {
                        $area = 'Estudios Específicos';
                    }
                    if ($curso->tipo == 'ESPECIALIDAD') {
                        $area = 'Estudios de Especialidad';
                    }
    
                    $sumilla = Sumilla::where('id_curso', $curso->id)->first();
                    $sumilla->contenido_sumillas = 'La asignatura de '.$curso->nombre. ' pertenece al área de '.$area. ', es de naturaleza '. $curso->naturaleza.' y de carácter '.$curso->estado.' , tiene como propósito que el estudiante '.$buscar_capacidad->contenido.'. Se trabajan los siguientes bloques temáticos: a).... b).... c).... d)..... . Estrategias de enseñanza - aprendizaje básicas: ....';
                    $sumilla->save();
        
                    return response()->json(true);
                }
            }
            if ($programa_estudio->num_ciclos == 12) {
                if($cantidad_curso>7 || $request->curso['creditos']+$creditaje_verdadero-$credito_electivo>23 || $cantidad_creditaje_total>264){
                    return response()->json("2");
                }else{
                    $curso = CursosPlanEstudios::find($request->curso['id']);
                    $curso->nombre = $nombre_masc;
                    $curso->ciclo = $request->curso['ciclo'];
                    $curso->tipo = $request->curso['tipo'];
                    $curso->estado = $request->curso['estado'];
                    if($request->curso['ht']>0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Teórico / Práctico';
                    }
                    if($request->curso['ht'] == 0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Práctico';
                    }
                    if($request->curso['ht']>0 && $request->curso['hp']== 0){
                        $curso->naturaleza = 'Teórico';
                    }  
                    $curso->ht = $request->curso['ht'];
                    $curso->hp = $request->curso['hp'];
                    $curso->h_semana = $request->curso['total'];
                    $curso->total_h = $request->curso['total']*16;
                    $curso->codigo_capacitaciones = $buscar_capacidad->codigo;
                    $curso->creditos = $request->curso['creditos'];
                    
                    $cantidad_curso = count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('tipo','!=','EXTRACURRICULAR')->get());
        
                    
                    if ($request->curso['ciclo'] == 'I') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 0';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 0';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 0';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 0';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 0';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 0';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 0';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 0';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 0';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 0';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 0';
                        }
                        
                    }
                    if ($request->curso['ciclo'] == 'II') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -140';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -140';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -140';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -140';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -140';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -140';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -140';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -140';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -140';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -140';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -140';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'III') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -260';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -260';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -260';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -260';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -260';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -260';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -260';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -260';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -260';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -260';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -260';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -380';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -380';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -380';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -380';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -380';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -380';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -380';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -380';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -380';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -380';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -380';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'V') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -500';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -500';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -500';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -500';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -500';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -500';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -500';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -500';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -500';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -500';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -500';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -620';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -620';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -620';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -620';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -620';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -620';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -620';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -620';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -620';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -620';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -620';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -740';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -740';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -740';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -740';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -740';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -740';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -740';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -740';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -740';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -740';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -740';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -860';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -860';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -860';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -860';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -860';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -860';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -860';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -860';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -860';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -860';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -860';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IX') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -980';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -980';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -980';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -980';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -980';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -980';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -980';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -980';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -980';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -980';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -980';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'X') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1100';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1100';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1100';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1100';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1100';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1100';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1100';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1100';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1100';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1100';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1100';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1220';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1220';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1220';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1220';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1220';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1220';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1220';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1220';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1220';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1220';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1220';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1340';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1340';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1340';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1340';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1340';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1340';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1340';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1340';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1340';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1340';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1340';
                        }
                    }
                    
                    
                    if ($request->curso['tipo'] == 'GENERAL') {
                        $curso->color = '#5FC341';
                    }
                    if ($request->curso['tipo'] == 'ESPECIALIDAD') {
                        $curso->color = '#41BCC3';
                    }
                    if ($request->curso['tipo'] == 'ESPECÍFICO') {
                        $curso->color = '#F76725';
                    }
        
                    $curso->save();
    
                    //eliminamos requisitos
                    $requisitos_curso = CursoRequisito::where('id_curso', $curso->id)->get();
    
                    if(count($requisitos_curso)>0){
                        foreach ($requisitos_curso as $item) {
                            $item->delete();
                        }
                    }
    
                    //eliminamos departamento
                    $departamento_curso = CursoDepartamento::where('id_curso', $curso->id)->get();
    
                    if(count($departamento_curso)>0){
                        foreach ($departamento_curso as $item) {
                            $item->delete();
                        }
                    }
    
        
                    if(isset($request->curso['requisitos'])){
                        for ($j=0; $j < sizeof($request->curso['requisitos']) ; $j++) { 
                            $requisitos = new CursoRequisito();
                            $requisitos->id_curso = $curso->id;
                            $requisitos->id_requisito = $request->curso['requisitos'][$j];
                            $requisitos->save();
                        }
                    }
        
                    if(isset($request->curso['departamentos'])){
                        for ($k=0; $k < sizeof($request->curso['departamentos']) ; $k++) { 
                            $departamentos = new CursoDepartamento();
                            $departamentos->id_curso = $curso->id;
                            $departamentos->id_departamento = $request->curso['departamentos'][$k];
                            $departamentos->save();
                        }
                    }             
    
                    if ($curso->tipo == 'GENERAL') {
                        $area = 'Estudios Generales';
                    }
                    if ($curso->tipo == 'ESPECÍFICO') {
                        $area = 'Estudios Específicos';
                    }
                    if ($curso->tipo == 'ESPECIALIDAD') {
                        $area = 'Estudios de Especialidad';
                    }
    
                    $sumilla = Sumilla::where('id_curso', $curso->id)->first();
                    $sumilla->contenido_sumillas = 'La asignatura de '.$curso->nombre. ' pertenece al área de '.$area. ', es de naturaleza '. $curso->naturaleza.' y de carácter '.$curso->estado.' , tiene como propósito que el estudiante '.$buscar_capacidad->contenido.'. Se trabajan los siguientes bloques temáticos: a).... b).... c).... d)..... . Estrategias de enseñanza - aprendizaje básicas: ....';
                    $sumilla->save();
        
                    return response()->json(true);
                }
            }
            if ($programa_estudio->num_ciclos == 14) {
                if($cantidad_curso>7 || $request->curso['creditos']+$creditaje_verdadero-$credito_electivo>23 || $cantidad_creditaje_total>308){
                    return response()->json("2");
                }else{
                    $curso = CursosPlanEstudios::find($request->curso['id']);
                    $curso->nombre = $nombre_masc;
                    $curso->ciclo = $request->curso['ciclo'];
                    $curso->tipo = $request->curso['tipo'];
                    $curso->estado = $request->curso['estado'];
                    if($request->curso['ht']>0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Teórico / Práctico';
                    }
                    if($request->curso['ht'] == 0 && $request->curso['hp']>0){
                        $curso->naturaleza = 'Práctico';
                    }
                    if($request->curso['ht']>0 && $request->curso['hp']== 0){
                        $curso->naturaleza = 'Teórico';
                    }  
                    $curso->ht = $request->curso['ht'];
                    $curso->hp = $request->curso['hp'];
                    $curso->h_semana = $request->curso['total'];
                    $curso->total_h = $request->curso['total']*16;
                    $curso->codigo_capacitaciones = $buscar_capacidad->codigo;
                    $curso->creditos = $request->curso['creditos'];
                    
                    $cantidad_curso = count(CursosPlanEstudios::where('id_plan_estudio', $request->plan_estudio_id)->where('ciclo', $request->curso['ciclo'])->where('tipo','!=','EXTRACURRICULAR')->get());
        
                    
                    if ($request->curso['ciclo'] == 'I') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 0';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 0';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 0';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 0';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 0';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 0';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 0';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 0';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 0';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 0';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 0';
                        }
                        
                    }
                    if ($request->curso['ciclo'] == 'II') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -140';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -140';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -140';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -140';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -140';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -140';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -140';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -140';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -140';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -140';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -140';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'III') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -260';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -260';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -260';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -260';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -260';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -260';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -260';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -260';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -260';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -260';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -260';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -380';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -380';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -380';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -380';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -380';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -380';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -380';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -380';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -380';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -380';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -380';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'V') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -500';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -500';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -500';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -500';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -500';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -500';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -500';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -500';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -500';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -500';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -500';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -620';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -620';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -620';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -620';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -620';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -620';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -620';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -620';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -620';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -620';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -620';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -740';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -740';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -740';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -740';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -740';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -740';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -740';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -740';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -740';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -740';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -740';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'VIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -860';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -860';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -860';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -860';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -860';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -860';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -860';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -860';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -860';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -860';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -860';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'IX') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -980';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -980';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -980';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -980';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -980';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -980';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -980';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -980';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -980';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -980';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -980';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'X') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1100';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1100';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1100';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1100';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1100';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1100';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1100';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1100';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1100';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1100';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1100';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XI') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1220';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1220';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1220';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1220';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1220';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1220';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1220';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1220';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1220';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1220';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1220';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1340';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1340';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1340';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1340';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1340';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1340';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1340';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1340';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1340';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1340';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1340';
                        }
                    }

                    if ($request->curso['ciclo'] == 'XIII') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1460';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1460';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1460';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1460';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1460';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1460';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1460';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1460';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1460';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1460';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1460';
                        }
                    }
                    
                    if ($request->curso['ciclo'] == 'XIV') {
                        if ($cantidad_curso == 0) {
                            $curso->posicion = '140 -1580';
                        }
                        if ($cantidad_curso == 1) {
                            $curso->posicion = '260 -1580';
                        }
                        if ($cantidad_curso == 2) {
                            $curso->posicion = '380 -1580';
                        }
                        if ($cantidad_curso == 3) {
                            $curso->posicion = '500 -1580';
                        }
                        if ($cantidad_curso == 4) {
                            $curso->posicion = '620 -1580';
                        }
                        if ($cantidad_curso == 5) {
                            $curso->posicion = '740 -1580';
                        }
                        if ($cantidad_curso == 6) {
                            $curso->posicion = '860 -1580';
                        }
                        if ($cantidad_curso == 7) {
                            $curso->posicion = '980 -1580';
                        }
                        if ($cantidad_curso == 8) {
                            $curso->posicion = '1100 -1580';
                        }
                        if ($cantidad_curso == 9) {
                            $curso->posicion = '1220 -1580';
                        }
                        if ($cantidad_curso == 10) {
                            $curso->posicion = '1340 -1580';
                        }
                    }
                    
                    
                    if ($request->curso['tipo'] == 'GENERAL') {
                        $curso->color = '#5FC341';
                    }
                    if ($request->curso['tipo'] == 'ESPECIALIDAD') {
                        $curso->color = '#41BCC3';
                    }
                    if ($request->curso['tipo'] == 'ESPECÍFICO') {
                        $curso->color = '#F76725';
                    }
        
                    $curso->save();
    
                    //eliminamos requisitos
                    $requisitos_curso = CursoRequisito::where('id_curso', $curso->id)->get();
    
                    if(count($requisitos_curso)>0){
                        foreach ($requisitos_curso as $item) {
                            $item->delete();
                        }
                    }
    
                    //eliminamos departamento
                    $departamento_curso = CursoDepartamento::where('id_curso', $curso->id)->get();
    
                    if(count($departamento_curso)>0){
                        foreach ($departamento_curso as $item) {
                            $item->delete();
                        }
                    }
    
        
                    if(isset($request->curso['requisitos'])){
                        for ($j=0; $j < sizeof($request->curso['requisitos']) ; $j++) { 
                            $requisitos = new CursoRequisito();
                            $requisitos->id_curso = $curso->id;
                            $requisitos->id_requisito = $request->curso['requisitos'][$j];
                            $requisitos->save();
                        }
                    }
        
                    if(isset($request->curso['departamentos'])){
                        for ($k=0; $k < sizeof($request->curso['departamentos']) ; $k++) { 
                            $departamentos = new CursoDepartamento();
                            $departamentos->id_curso = $curso->id;
                            $departamentos->id_departamento = $request->curso['departamentos'][$k];
                            $departamentos->save();
                        }
                    }             
    
                    if ($curso->tipo == 'GENERAL') {
                        $area = 'Estudios Generales';
                    }
                    if ($curso->tipo == 'ESPECÍFICO') {
                        $area = 'Estudios Específicos';
                    }
                    if ($curso->tipo == 'ESPECIALIDAD') {
                        $area = 'Estudios de Especialidad';
                    }
    
                    $sumilla = Sumilla::where('id_curso', $curso->id)->first();
                    $sumilla->contenido_sumillas = 'La asignatura de '.$curso->nombre. ' pertenece al área de '.$area. ', es de naturaleza '. $curso->naturaleza.' y de carácter '.$curso->estado.' , tiene como propósito que el estudiante '.$buscar_capacidad->contenido.'. Se trabajan los siguientes bloques temáticos: a).... b).... c).... d)..... . Estrategias de enseñanza - aprendizaje básicas: ....';
                    $sumilla->save();
        
                    return response()->json(true);
                }
            }
        }
    }

    public function storeArticulacionCursoExistente(Request $request){
        $buscar_articulacion = MapaCurricular::where('id_capacidad', $request->capacidad_id)
        ->where('id_curso_plan_estudios', $request->curso_existente_id)->first();
        if(isset($buscar_articulacion)){
            return response()->json(false);
        }else{

            $mapa = new MapaCurricular();
            $mapa->id_capacidad = $request->capacidad_id;
            $mapa->id_curso_plan_estudios = $request->curso_existente_id;
            $mapa->save();

            return response()->json(true);
        }
    }

    public function getCursoEditar($id_curso){
        $curso = CursosPlanEstudios::find($id_curso);

        $departamentos = CursoDepartamento::where('id_curso', $id_curso)->get();

        $requisitos = CursoRequisito::where('id_curso', $id_curso)->get();

        return response()->json([$curso, $departamentos, $requisitos]);
    }

    public function deleteCurso($id_curso){
        try {
             $curso = CursosPlanEstudios::find($id_curso);
            if($curso->tipo == 'GENERAL' || $curso->tipo == 'EXTRACURRICULAR'){
                
                return response()->json(false);

            }else{

                $curso_departamento = CursoDepartamento::where('id_curso', $curso->id)->get();
                foreach ($curso_departamento as $item) {
                    $item->delete();
                }

                $curso_requisito = CursoRequisito::where('id_requisito', $curso->id)->get();
                if(isset($curso_requisito)){
                    foreach ($curso_requisito as $item2) {
                        $item2->delete();
                    }
                }
                

                $curso_requisito2 = CursoRequisito::where('id_curso', $curso->id)->get();
                if(isset($curso_requisito2)){
                    foreach ($curso_requisito2 as $item4) {
                        $item4->delete();
                    }
                }
               

                $mapa = MapaCurricular::where('id_curso_plan_estudios', $curso->id)->get();
                foreach ($mapa as $item3) {
                    $item3->delete();
                }

                $sumilla = Sumilla::where('id_curso', $curso->id)->first();
                $sumilla->delete();


                $curso->delete();

                DB::commit();
                return response()->json(true);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json(false);
        }
    }
}
