<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramaEstudios;
use App\Models\Anexo;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Log;

class AnexoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        //buscamos la anexo
        $data = Anexo::where('id_programa_estudios', $programa_estudio->id)->first();
        if(isset($data)){
            $anexo = $data;
        }else{
            $anexo = new Anexo();
            $anexo->id_programa_estudios = $programa_estudio->id;
            $anexo->save();
        }

        return view('admin.pages.anexo.index')->with(compact('anexo', 'programa_estudio'));
    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        $anexo = Anexo::where('id_programa_estudios', $programa_estudio->id)->first();
        $image_path = public_path().'/anexos/'.$anexo->anexo;

        if ($request->file('anexo')) {
            if (!is_null($anexo->anexo)) {
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            
            $file = $request->file('anexo');
            $name = 'anexo_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/anexos/';
            $file->move($path, $name);
    
            $anexo->anexo = $name;
        }
        $anexo->save();

        return back()->with('mensaje', 'Archivo de Anexo actualizado correctamente');
    }

    
    public function reporte(){
        $user_id = auth()->user()->id;
        if(auth()->user()->rol == 'supervisor'  ){
            $programa_estudio = ProgramaEstudios::where('id_user2', $user_id)->first();
        }else{
            $programa_estudio = ProgramaEstudios::where('id_user', $user_id)->first();
        }
        $anexo = Anexo::where('id_programa_estudios', $programa_estudio->id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('admin.pages.anexo.reporte', compact('anexo'))
                ->setPaper('a4', 'portrait');

       //return $pdf->download('anexo.pdf');
        return $pdf->stream();
    }
}
