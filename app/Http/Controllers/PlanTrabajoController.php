<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanTrabajo;
use App\Models\IntegrantesPlanTrabajo;
use App\Models\ProgramaEstudios;
use Barryvdh\DomPDF\Facade as PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use DB;

class PlanTrabajoController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }
    
    


    public function index(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        //buscamos la perfil
        $data = PlanTrabajo::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $plan_trabajo = $data;
        }else{
            $plan_trabajo = new PlanTrabajo();
            $plan_trabajo->id_programa_estudios = $programa_estudio->id;
            $plan_trabajo->save();
        }

        $integrantes = IntegrantesPlanTrabajo::where('id_plan_trabajo', $plan_trabajo->id)->get();

        return view('admin.pages.plan_trabajo.index')->with(compact('plan_trabajo', 'programa_estudio','integrantes'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $plan_trabajo = PlanTrabajo::where('id_programa_estudios', $programa_estudio->id)->first();
        $plan_trabajo->facultad = $request->facultad;
        $plan_trabajo->nro_resolucion = $request->nro_resolucion;
        $plan_trabajo->contextualizacion = $request->contextualizacion;
        $plan_trabajo->observacion = NULL;
        $plan_trabajo->conformidad = NULL;
        if ($request->file('resolucion')) {
            if(!is_null($plan_trabajo->resolucion)){
                $pathToYourFile = public_path().'/resoluciones/'.$plan_trabajo->resolucion;
                if(file_exists($pathToYourFile)) { 
                       unlink($pathToYourFile);  
                   } 
            }
         
            //Portada de la Revista
            $file = $request->file('resolucion');
            $name = 'resolucion_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/resoluciones/';
            $file->move($path, $name);
            $plan_trabajo->resolucion = $name;
        }

        if ($request->file('acta_aprobacion')) {
            if(!is_null($plan_trabajo->acta_aprobacion)){
                $pathToYourFile = public_path().'/actas/'.$plan_trabajo->acta_aprobacion;
                if(file_exists($pathToYourFile)) { 
                       unlink($pathToYourFile);  
                   } 
            }
         
            //Portada de la Revista
            $file = $request->file('acta_aprobacion');
            $name = 'acta_aprobacion_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/actas/';
            $file->move($path, $name);
            $plan_trabajo->acta_aprobacion = $name;
        }

        if ($request->file('evidencias')) {
            if(!is_null($plan_trabajo->evidencias)){
                $pathToYourFile = public_path().'/evidencias/'.$plan_trabajo->evidencias;
                if(file_exists($pathToYourFile)) { 
                       unlink($pathToYourFile);  
                   } 
            }
         
            //Portada de la Revista
            $file = $request->file('evidencias');
            $name = 'evidencias_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/evidencias/';
            $file->move($path, $name);
            $plan_trabajo->evidencias = $name;
        }


        $plan_trabajo->save();

        return back()->with('mensaje', 'Los datos del plan de trabajo se actualizaron correctamente');
    }


    public function storeIntegrante(Request $request){
        $plan_trabajo = PlanTrabajo::find($request->id_plan_trabajo);
        $plan_trabajo->observacion = NULL;
        $plan_trabajo->conformidad = NULL;
        $plan_trabajo->save();
        
        $integrante = new  IntegrantesPlanTrabajo();
        $integrante->id_plan_trabajo = $request->id_plan_trabajo;
        $integrante->apellido = $request->apellido;
        $integrante->nombre = $request->nombre;
        $integrante->cargo = $request->cargo;
        if ($request->file('firma')) {
            //Portada de la Revista
            $file = $request->file('firma');
            $name = 'firma_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/firmas/';
            $file->move($path, $name);
            $integrante->firma = $name;
        }

        $integrante->save();
        return back()->with('mensaje', 'Integrante agregado');
    }

    public function editIntegrante($id){
        $integrante = IntegrantesPlanTrabajo::find($id);
        return view('admin.pages.plan_trabajo.edit_integrante')->with(compact('integrante'));
    }

    public function updateIntegrante(Request $request){
        $integrante = IntegrantesPlanTrabajo::findOrFail($request->id);
        $integrante->apellido = $request->apellido;
        $integrante->nombre = $request->nombre;
        $integrante->cargo = $request->cargo;
        if(isset($request->firma)){
            $pathToYourFile = public_path().'/firmas/'.$integrante->firma;
            if(file_exists($pathToYourFile)) { 
                   unlink($pathToYourFile);  
               } 
            
            if ($request->file('firma')) {
                //Portada de la Revista
                $file = $request->file('firma');
                $name = 'firma_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/firmas/';
                $file->move($path, $name);
                $integrante->firma = $name;
            }
        }

        $integrante->save();
        
        return back()->with('mensaje', 'Integrante actualizado');
    }

    public function deleteIntegrante($id){
        DB::transaction(function () use ($id) { 
            $integrante = IntegrantesPlanTrabajo::findOrFail($id);       
            $pathToYourFile = public_path().'/firmas/'.$integrante->firma;
             if(file_exists($pathToYourFile)) { 
                    unlink($pathToYourFile);  
                } 
            $integrante->delete();
        });                

        return redirect()->back();
    }

    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
     
        $plan_trabajo = PlanTrabajo::where('id_programa_estudios', $programa_estudio->id)->first();
        $integrantes = IntegrantesPlanTrabajo::where('id_plan_trabajo', $plan_trabajo->id)->get();
        $presidente = IntegrantesPlanTrabajo::where('id_plan_trabajo', $plan_trabajo->id)->where('cargo', 'Presidente')->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.plan_trabajo.reporte', compact('plan_trabajo', 'integrantes', 'presidente'))
                ->setPaper('a4', 'portrait');

        //Donde guardar el documento
        $rutaGuardado = public_path().'/plan_trabajo/';
        //Nombre del Documento.
        $nombreArchivo = $programa_estudio->nombre_programa.".pdf";
        //Actualizo la ruta
  
        //Renderiza el archivo primero

        //Guardalo en una variable
        //$output = $pdf->output();

       // file_put_contents( $rutaGuardado.$nombreArchivo, $output);
        $pdf->save('plan_trabajo/'.$nombreArchivo);

        $pdfFile1Path = public_path() . '/resoluciones/'.$plan_trabajo->resolucion;
        $pdfFile2Path = public_path() . '/actas/'.$plan_trabajo->acta_aprobacion;
        $pdfFile3Path = public_path() . '/evidencias/'.$plan_trabajo->evidencias;

        $pdfMerger = PDFMerger::init();
        // Agregue todas las páginas del PDF para fusionar
        $pdfMerger->addPDF(public_path('plan_trabajo/'.$nombreArchivo), 'all');
        if(!is_null($plan_trabajo->resolucion)){
            $pdfMerger->addPDF($pdfFile1Path, 'all');
        }
        if(!is_null($plan_trabajo->acta_aprobacion)){
            $pdfMerger->addPDF($pdfFile2Path, 'all');
        }
        if(!is_null($plan_trabajo->evidencias)){
            $pdfMerger->addPDF($pdfFile3Path, 'all');
        }
        
        

        $pdfMerger->merge();
        $pdfMerger->save(($nombreArchivo), "browser");

        $plan_trabajo->ruta_archivo = $nombreArchivo;
        $plan_trabajo->save();

          
        //return $pdf->download('plan_trabajo.pdf');
       // return $pdfMerger->stream();
    }

    public function validar(Request $request){
        $plan_trabajo = PlanTrabajo::find($request->id_plan_trabajo);
        $plan_trabajo->observacion = $request->observacion;
        $plan_trabajo->conformidad = $request->conformidad;
        $plan_trabajo->save();

        return back()->with('mensaje', 'Validación confirmada');
    }
}
