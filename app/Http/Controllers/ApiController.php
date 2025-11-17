<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
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
use App\Models\SistemaEvaluacion;
use App\Models\Lineamiento;
use App\Models\Capacidades;
use App\Models\Sumilla;
use App\Models\CursosPlanEstudios;
use App\Models\EjeCurricular;
use App\Models\MallaCurricular;
use App\Models\Indice;
use App\Models\TablaConvalidaciones;
use App\Models\DetalleTablaConvalidaciones;
use Barryvdh\DomPDF\Facade as PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use DB;

class ApiController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }
    


    public function getDepartamentos(){
        $departamentos = DB::table('departamentos')->select('id', 'nombre_departamento as text')->get();
        return response()->json($departamentos);
    }

    public function getCapacidades($id_competencia){
        $capacidades = Capacidades::where('id_competencia', $id_competencia)->get();
        return response()->json($capacidades);
    }

    
    public function lineamientos(){
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.lineamientos.reporte')
                ->setPaper('a4', 'portrait');

        //return $pdf->download('lineamientos.pdf');
        return $pdf->stream();
    }

    public function sistemaEvaluacion(){
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.sistema_evaluacion.reporte')
                ->setPaper('a4', 'portrait');

       // return $pdf->download('sistema_evaluacion.pdf');
        return $pdf->stream();
    }

    public function reporteCurriculo(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_estudio = PlanEstudio::where('id_programa_estudios', $programa_estudio->id)->first();
        $indice = Indice::where('id_programa_estudios', $programa_estudio->id)->first();

        $caratula = Caratula::where('id_programa_estudios', $programa_estudio->id)->first();
        $presentacion = Presentacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $introduccion = Introduccion::where('id_programa_estudios', $programa_estudio->id)->first();
        $sistema_evaluacion = SistemaEvaluacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $lineamiento = Lineamiento::where('id_programa_estudios', $programa_estudio->id)->first();
        $presentacion = Presentacion::where('id_programa_estudios', $programa_estudio->id)->first();
        $estudio_demanda = EstudioDemanda::where('id_programa_estudios', $programa_estudio->id)->first();
        $perfil = Perfil::where('id_programa_estudios', $programa_estudio->id)->first();
        $objetivo = ObjetivoEducacional::where('id_programa_estudios', $programa_estudio->id)->first();
        $estrategia = EstrategiaEnsenanza::where('id_programa_estudios', $programa_estudio->id)->first();
        $base_general = BaseGeneral::where('id_programa_estudios', $programa_estudio->id)->first();
        $competencias = Competencias::where('id_programa_estudios', $programa_estudio->id)->where('id_tipo_competencia', 2)->get();
        $referencia = Referencia::where('id_programa_estudios', $programa_estudio->id)->first();
        $anexo = Anexo::where('id_programa_estudios', $programa_estudio->id)->first();
        $malla = MallaCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        $eje_curricular = EjeCurricular::where('id_programa_estudios', $programa_estudio->id)->first();
        $tabla_convalidacion = TablaConvalidaciones::where('id_programa_estudios', $programa_estudio->id)->first();
        $detalle = DetalleTablaConvalidaciones::where('id_tabla_convalidaciones', $tabla_convalidacion->id)->orderBy('ciclo','DESC')->get();
        $competenciasGeneral = Competencias::where('id_programa_estudios', $programa_estudio->id)->where('id_tipo_competencia', 1)->get();
        $competenciasEspecifico = Competencias::where('id_programa_estudios', $programa_estudio->id)->where('id_tipo_competencia', 2)->get();
        if(isset($plan_estudio)){
            $cursos = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->get();
            $cursos2 = CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->get();
        }else{
            $cursos = [];
            $cursos2 =[];
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

        $competenciasG = Competencias::where('id_tipo_competencia', 1)
        ->where('id_programa_estudios', $programa_estudio->id)->get();
        $tcapacidadesG = Capacidades::select('capacidades.*')
        ->join('competencias', 'capacidades.id_competencia', '=', 'competencias.id')
        ->where('competencias.id_programa_estudios', $programa_estudio->id)
        ->where('competencias.id_tipo_competencia', 1 )
        ->get();
        $competenciasE = Competencias::where('id_tipo_competencia', 2)
        ->where('id_programa_estudios', $programa_estudio->id)->get();
        $tcapacidadesE = Capacidades::select('capacidades.*')
                ->join('competencias', 'capacidades.id_competencia', '=', 'competencias.id')
                ->where('competencias.id_programa_estudios', $programa_estudio->id)
                ->where('competencias.id_tipo_competencia', 2 )
                ->get();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadView('admin.pages.reporte_curriculo', compact('caratula', 'presentacion', 'introduccion', 'estudio_demanda', 'perfil', 'objetivo',
            'estrategia', 'base_general', 'competencias', 'referencia', 'anexo', 'malla', 'eje_curricular','competenciasGeneral','competenciasEspecifico',
             'cursos', 'plan_estudio', 'sumillas', 'cursos2','indice', 'competenciasG', 'tcapacidadesG', 'competenciasE','tcapacidadesE','sistema_evaluacion',
             'lineamiento','detalle'))
        ->setPaper('a4', 'portrait');

        //return $pdf->download('curriculo_final.pdf');
        $rutaGuardado = public_path().'/curriculo/';
        //Nombre del Documento.
        $nombreArchivo = $programa_estudio->nombre_programa.".pdf";
        //Actualizo la ruta
  
        //Renderiza el archivo primero

        //Guardalo en una variable
        //$output = $pdf->output();

       // file_put_contents( $rutaGuardado.$nombreArchivo, $output);
        $pdf->save('curriculo/'.$nombreArchivo);

        $pdfFile1Path = public_path() . '/anexos/'.$anexo->anexo;

        $pdfMerger = PDFMerger::init();
        // Agregue todas las páginas del PDF para fusionar
        $pdfMerger->addPDF(public_path('curriculo/'.$nombreArchivo), 'all');
        if(!is_null($anexo->anexo)){
            $pdfMerger->addPDF($pdfFile1Path, 'all');
        }

        
        $pdfMerger->merge();
        $pdfMerger->save(($nombreArchivo), "browser");

        $programa_estudio->ruta_archivo = $nombreArchivo;
        $programa_estudio->save();
        //return $pdf->stream();
    }
}
