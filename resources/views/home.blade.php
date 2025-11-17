@extends('admin.layouts._principal')

@section('css')
 <style>
    .verde-pastel{
        background-color: #A6D171 !important;
        border: 1px solid #A6D171 !important;
    }
    .rojo-pastel{
        background-color: #E6746C !important;
        border: 1px solid #E6746C !important;
    }
    .amarillo-pastel{
        background-color: #F5D87B !important;
        border: 1px solid #F5D87B !important;
    }
 </style>
@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1 class="m-0"><b> Panel de Control</b></h1>
        </div><!-- /.col -->
        <div class="col-sm-9">
          <ol class="breadcrumb float-sm-right">
            <b>Leyenda: </b> <button class="btn btn-danger rojo-pastel" style="margin-left: 20px; padding-left: 30px;
            margin-right: 5px;"> </button> Sin iniciar   <button class="btn btn-warning amarillo-pastel" style="margin-left: 20px; padding-left: 30px;
            margin-right: 5px;"> </button> Por completar  
            <button class="btn btn-success verde-pastel" style="margin-left: 20px; padding-left: 30px;
            margin-right: 5px;"> </button> Completado
            </button> 
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Advertencia:</strong> Ingresar contenido curricular pertinente para los programas de estudios de pregrado, en base a la Ley Universitaria N° 30220 y/o alguna Resolución de Consejo Universitario actualizada, de lo contrario no podrá llegar al nivel de "Completado" en el sistema de curriculo.
      <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
@endsection

@section('contenido')
<div class="container">
    <!--<div class="row">
        <div class="col-sm-12">
            <label for="Nivel de Progreso">Nivel de Progreso:</label>
            <div class="progress">
                <div class="progress-bar verde-pastel" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
            </div>
        </div>
    </div>-->
    <div class="row mt-1">
    <div class="col-sm-3">
        @if (isset($caratula))
            <div class="card h-100 @if(is_null($caratula->rcf) || is_null($caratula->rcu)) amarillo-pastel @else verde-pastel @endif" >
        @else
            <div class="card h-100 rojo-pastel" >
        @endif
            <div class="card-body">
            <p class="card-text text-center"> CARÁTULA</p>
            <div class="text-center">
                @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('caratula')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                @endif
                
                @if (isset($caratula))
                    @if(!is_null($caratula->rcf) && !is_null($caratula->rcu))
                        <a target="_blank" href="{{route('caratula.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @if (auth()->user()->rol == 'supervisor')
                            <a  href="#"  data-toggle="modal" data-target="#validar-caratula"  class="card-link btn btn-warning"><i class="fa fa-check"></i></a>
                        @endif
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                @else
                    <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                @endif
            </div>
            </div>
        </div>

        <!--modall-->
        <div class="modal fade" id="validar-caratula">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">EVALUACIÓN</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('competencia.store')}}" method="POST">
                    {{ csrf_field() }}
                <div class="modal-body">
                  <div class="row">
                        
                        <div class="col-sm-12">
                            <label>Comentario: </label>
                            <textarea name="contenido" class="form-control" cols="30" rows="5" required></textarea>
                        </div>
                  </div>       
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        <!--dsad-->
    </div>
    <div class="col-sm-3">
        @if (isset($credito))
            <div class="card h-100 @if(is_null($credito->contenido)) amarillo-pastel @else verde-pastel @endif" >
        @else
            <div class="card h-100 rojo-pastel" >
        @endif
            <div class="card-body">
            <p class="card-text text-center"> CRÉDITOS (RESPONSABLES)</p>
            <div class="text-center">
                @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('credito')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                @endif
               
                @if (isset($credito))
                    @if(!is_null($credito->contenido))
                        <a target="_blank"  href="{{route('credito.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                @else
                    <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                @endif
               
            </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        @if (isset($presentacion))
            <div class="card h-100 @if(is_null($presentacion->contenido)) amarillo-pastel @else verde-pastel @endif" >
        @else
            <div class="card h-100 rojo-pastel" >
        @endif
            <div class="card-body">
            <p class="card-text text-center"> PRESENTACIÓN</p>
            <div class="text-center">
                @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('presentacion')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                @endif
               
                @if (isset($presentacion))
                    @if(!is_null($presentacion->contenido))
                        <a target="_blank"  href="{{route('presentacion.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                @else
                    <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                @endif
               
            </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        @if (isset($introduccion))
            <div class="card h-100 @if(is_null($introduccion->contenido)) amarillo-pastel @else verde-pastel @endif" >
        @else
            <div class="card h-100 rojo-pastel" >
        @endif
            <div class="card-body">
            <p class="card-text text-center"> INTRODUCCIÓN</p>
            <div class="text-center">
                @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                <a href="{{route('introduccion')}}" class="card-link btn btn-info">
                    <i class="fa fa-edit"></i></a>
                @endif
                
                @if (isset($introduccion))
                    @if(!is_null($introduccion->contenido))
                        <a target="_blank"  href="{{route('introduccion.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                @else
                    <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                @endif
            </div>
            </div>
        </div>
    </div>
    
    </div>
    
    <div class="row mt-3">
       <!--bases del curricul-->
    <div class="col-sm-3">
        @if (isset($base_general))
                <div class="card h-100 @if(is_null($base_general->bi_fac_mision) || is_null($base_general->bi_fac_vision) ) 
                amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
            <div class="card-body">
            <p class="card-text text-center"> BASES DEL CURRÍCULO</p>
            <div class="text-center">
                @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                <a href="{{route('base_general')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                @endif
                
                @if (isset($base_general))
                    @if(!is_null($base_general->bi_fac_mision) && !is_null($base_general->bi_fac_vision && !is_null($base_general->bi_principios_facultad)))
                        <a target="_blank"  href="{{route('base_general.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                @else
                    <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                @endif
                
            </div>
            </div>
        </div>
    </div>

    <!--contextualizacion-->
    <div class="col-sm-3">
        @if (isset($contextualizacion))
                <div class="card h-100 @if(is_null($contextualizacion->sintesis) || is_null($contextualizacion->determinacion) || is_null($contextualizacion->desarrollo) ) 
                amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
            <div class="card-body">
            <p class="card-text text-center"> CONTEXTUALIZACIÓN DEL PROGRAMA DE ESTUDIOS</p>
            <div class="text-center">
                @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                <a href="{{route('contextualizacion')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                @endif
                
                @if (isset($contextualizacion))
                    @if(!is_null($contextualizacion->sintesis) && !is_null($contextualizacion->determinacion && !is_null($contextualizacion->desarrollo)))
                        <a target="_blank"  href="{{route('contextualizacion.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                @else
                    <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                @endif
                
            </div>
            </div>
        </div>
    </div>
    <!--fin-->

    
        <!--PERFILES -->
        <div class="col-sm-3">
            @if (isset($perfil))
                <div class="card h-100 @if(is_null($perfil->ingreso) || is_null($perfil->egreso) || is_null($perfil->objetivos_programa) || is_null($perfil->objetivos_educacionales)) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
                <div class="card-body">
                <p class="card-text text-center">PERFILES Y OBJETIVOS DEL PROGRAMA PROFESIONAL</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('perfil')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                 
                    @if (isset($perfil))
                        @if(!is_null($perfil->ingreso) && !is_null($perfil->egreso) && !is_null($perfil->objetivos_programa) && !is_null($perfil->objetivos_educacionales))
                            <a target="_blank"  href="{{route('perfil.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @else
                            <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @endif
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
               
                </div>
                </div>
            </div>
        </div>
        <!--HASTA AQUI-->
        <!--COMPETENCIAS-->
        <div class="col-sm-3">
            @if (count($competencias)>0)
                <div class="card h-100 verde-pastel" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
                <div class="card-body">
                <p class="card-text text-center">COMPETENCIAS</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('competencias')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                    
                <a target="_blank"  href="{{route('competencias.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                </div>
                </div>
            </div>
        </div>
        <!--HASTA AQUI-->
    </div>
    <div class="row mt-3">
        
        
        <div class="col-sm-3">
            <div class="card h-100 verde-pastel"  >
                <div class="card-body">
                <p class="card-text text-center"> MATRIZ DE ARTICULACIÓN</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('mapa.curricular')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                 
                  
                    <a href="{{route('mapa.curricular.pdf')}}" target="_blank" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                <!--<a href="#" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>-->
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            @if (isset($malla))
                <div class="card h-100 @if(is_null($malla->malla)) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
                <div class="card-body">
                <p class="card-text text-center"> MALLA CURRICULAR</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('malla')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
            
                    @if (isset($malla))
                        @if(!is_null($malla->malla))
                            <a  href="{{route('malla.pdf')}}" target="_blank" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @else
                            <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @endif
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                   
                   
               <!-- <a href="#" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>-->
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            @if (!empty($cursos))
                <div class="card h-100 @if(($cursos->sum('creditos')<210)) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
                <div class="card-body">
                <p class="card-text text-center"> PLAN DE ESTUDIOS (CUADRO)</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('plan.estudios')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                  
                <a target="_blank"  href="{{route('plan.estudios.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                </div>
                </div>
            </div>
        </div>

        <!--SUMILLA-->
        <div class="col-sm-3">
            @if (count($sumillas) > 0)
                <?php 
                $c = 0;
                foreach ($sumillas as $item) {
                    if (is_null($item->contenido_sumillas) || is_null($item->ejes_transversales) || is_null($item->perfil_docente) ) {
                        $c++;
                    }
                } ?>
                <div class="card h-100 @if($c>0) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
                <div class="card-body">
                <p class="card-text text-center"> SUMILLAS (CUADRO)</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('sumillas')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
       
                <a  target="_blank"  href="{{route('sumilla.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                </div>
                </div>
            </div>
        </div>
        <!--HASTA AQUI-->
    </div>
    <div class="row mt-3">
        
        <div class="col-sm-3">
            <div class="card h-100 verde-pastel" >
                <div class="card-body">
                <p class="card-text text-center"> SISTEMA DE EVALUACIÓN</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a  href="{{route('sistema_evaluacion')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                   
                    <a  target="_blank"  href="{{route('sistema_evaluacion.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card h-100 verde-pastel" >
                <div class="card-body">
                <p class="card-text text-center"> LINEAMIENTOS DE GESTIÓN CURRICULAR</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a  href="{{route('lineamiento')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                    
          
                <a  target="_blank"  href="{{route('lineamiento.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                </div>
                </div>
            </div>
        </div>
        <!--REQUISITOS DE GRADUACIÓN Y TITULACIÓN-->
        <div class="col-sm-3">
            @if (isset($graduacion))
                    <div class="card h-100 @if(is_null($graduacion->contenido) ) 
                    amarillo-pastel @else verde-pastel @endif" >
                @else
                    <div class="card h-100 rojo-pastel" >
                @endif
                <div class="card-body">
                <p class="card-text text-center"> REQUISITOS DE GRADUACIÓN Y TITULACIÓN</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('graduacion')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                    
                    @if (isset($graduacion))
                        @if(!is_null($graduacion->contenido))
                            <a target="_blank"  href="{{route('graduacion.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @else
                            <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @endif
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                    
                </div>
                </div>
            </div>
        </div>
        <!-- HASTA AQUI-->

        <!--TABLA DE EQUIVALENCIAS-->
    <div class="col-sm-3">
        @if (isset($tabla_convalidacion))
        <div class="card h-100 @if(is_null($tabla_convalidacion->id_programa_estudios)) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel">
            @endif
                <div class="card-body">
                <p class="card-text text-center">TABLA DE EQUIVALENCIAS</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                        <a href="{{route('tabla_convalidacion')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                
                    @if (isset($tabla_convalidacion))
                        @if(!is_null($tabla_convalidacion->id_programa_estudios))
                            <a  target="_blank"  href="{{route('tabla_convalidacion.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @else
                            <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @endif
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                    
                </div>
                </div>
            </div>
        </div>
        <!--HASTA AQUI-->
        
    </div>
    <div class="row mt-3">
        <div class="col-sm-3">
            @if (isset($referencia))
                <div class="card h-100 @if(is_null($referencia->contenido)) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
                <div class="card-body">
                <p class="card-text text-center"> REFERENCIAS BIBLIOGRÁFICAS</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('referencia')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                   
                    @if (isset($referencia))
                        @if(!is_null($referencia->contenido))
                            <a  target="_blank"  href="{{route('referencia.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @else
                            <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @endif
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            @if (isset($anexo))
                <div class="card h-100 @if(is_null($anexo->anexo)) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel" >
            @endif
                <div class="card-body">
                <p class="card-text text-center"> ANEXOS</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                    <a href="{{route('anexo')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                  
                @if (isset($anexo))
                <a  href="{{asset('./anexos/'.$anexo->anexo)}}" target="_blank" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                @endif
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            @if (isset($indice))
                <div class="card h-100 @if(is_null($indice->n_presentacion)) amarillo-pastel @else verde-pastel @endif" >
            @else
                <div class="card h-100 rojo-pastel">
            @endif
                <div class="card-body">
                <p class="card-text text-center">INDICE</p>
                <div class="text-center">
                    @if (auth()->user()->rol == 'admin' || auth()->user()->rol == 'coteccu' )
                        <a href="{{route('indice')}}" class="card-link btn btn-info"><i class="fa fa-edit"></i></a>
                    @endif
                   
                    @if (isset($indice))
                        @if(!is_null($indice->n_presentacion))
                            <a  target="_blank"  href="{{route('indice.pdf')}}" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @else
                            <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                        @endif
                    @else
                        <a onclick="alert('Para ver La vista previa debe llenar el contenido')" class="card-link btn btn-dark"><i class="fa fa-eye"></i></a>
                    @endif
                    
                </div>
                </div>
            </div>
        </div>
    
    
    </div>
</div> 
    <br><br>
</div>
@endsection

@section('scripts')
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
@endsection