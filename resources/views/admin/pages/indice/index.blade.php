@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Indice de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Indice</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('contenido')
<div class="container">

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4" style="background-color: #F33154; color: white; border-radius: 10px">
                    <h2  align="center">INDICE</h2>
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-1">
                    <a href="#" data-toggle="modal" data-target="#info" 
                         class="btn btn-block btn-info"><i class="fa fa-question"></i></a>
                </div>
            </div>
        </div>
        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>
        @endif
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{route('indice.update')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <table class="" style="width: 100% !important">
                        <tbody>
                            <input type="hidden" name="id_programa_estudios" value="{{$programa_estudio->id}}" required class="form-control">
                            
                            <tr>
                                <td>PRESENTACIÓN ..............................................................................................................................................................................................</td>
                                <td><input type="number" name="n_presentacion" value="{{$indice->n_presentacion}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>INTRODUCCIÓN ..............................................................................................................................................................................................</td>
                                <td><input type="number" name="n_introduccion" value="{{$indice->n_introduccion}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>BASES GENERALES .........................................................................................................................................................................................</td>
                                <td><input type="number" name="n_bases_generales" value="{{$indice->n_bases_generales}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px"> - BASES NORMATIVAS ..............................................................................................................................................................................</td>
                                <td><input type="number" name="n_bases_normativas" value="{{$indice->n_bases_normativas}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px"> - BASES INSTITUCIONALES  ......................................................................................................................................................................</td>
                                <td><input type="number" name="n_bases_institucionales" value="{{$indice->n_bases_institucionales}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px"> - BASES TEÓRICO - CONCEPTUALES ........................................................................................................................................................</td>
                                <td><input type="number" name="n_bases_teorica" value="{{$indice->n_bases_teorica}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>ESTUDIO DE LA DEMANDA SOCIAL Y EL MERCADO LABORAL ........................................................................................................................</td>
                                <td><input type="number" name="n_estudio_demanda" value="{{$indice->n_estudio_demanda}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>OBJETIVOS EDUCACIONALES .........................................................................................................................................................................</td>
                                <td><input type="number" name="n_obj_educacionales" value="{{$indice->n_obj_educacionales}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>EJES CURRICULARES TRANSVERSALES ..........................................................................................................................................................</td>
                                <td><input type="number" name="n_ejes_curriculares" value="{{$indice->n_ejes_curriculares}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>COMPETENCIAS ...............................................................................................................................................................................................</td>
                                <td><input type="number" name="n_competencias"  value="{{$indice->n_competencias}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px">- GENÉRICAS  .............................................................................................................................................................................................</td>
                                <td><input type="number" name="n_genericas" value="{{$indice->n_genericas}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px">- ESPECÍFICAS ...........................................................................................................................................................................................</td>
                                <td><input type="number" name="n_especificas" value="{{$indice->n_especificas}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>PERFILES ..........................................................................................................................................................................................................</td>
                                <td><input type="number" name="n_perfiles" value="{{$indice->n_perfiles}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px">- DE INGRESO ............................................................................................................................................................................................</td>
                                <td><input type="number" name="n_perfil_ingreso" value="{{$indice->n_perfil_ingreso}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px">- DE EGRESO .............................................................................................................................................................................................</td>
                                <td><input type="number" name="n_perfil_egreso" value="{{$indice->n_perfil_egreso}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>MAPA CURRICULAR ..........................................................................................................................................................................................</td>
                                <td><input type="number" name="n_mapa_curricular" value="{{$indice->n_mapa_curricular}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>MALLA CURRICULAR .........................................................................................................................................................................................</td>
                                <td><input type="number" name="n_malla_curricular" value="{{$indice->n_malla_curricular}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>PLAN DE ESTUDIOS .........................................................................................................................................................................................</td>
                                <td><input type="number" name="n_plan_estudios" value="{{$indice->n_plan_estudios}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>SUMILLAS .........................................................................................................................................................................................................</td>
                                <td><input type="number" name="n_sumilla" value="{{$indice->n_sumilla}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>ESTRATEGIAS DE ENSEÑANZA APRENDIZAJE EN ENFOQUE POR COMPETENCIAS .....................................................................................</td>
                                <td><input type="number" name="n_estrategias_ensenanza" value="{{$indice->n_estrategias_ensenanza}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>LINEAMIENTOS DE GESTIÓN CURRICULAR ....................................................................................................................................................</td>
                                <td><input type="number" name="n_lineamientos" value="{{$indice->n_lineamientos}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>SISTEMA DE EVALUACIÓN ..............................................................................................................................................................................</td>
                                <td><input type="number" name="n_sistema_evaluacion" value="{{$indice->n_sistema_evaluacion}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px">- EVALUACIÓN DE LOS APRENDIZAJES ...................................................................................................................................................</td>
                                <td><input type="number" name="n_eval_aprendizaje" value="{{$indice->n_eval_aprendizaje}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px">- EVALUACIÓN DEL LOGRO DE COMPETENCIAS ......................................................................................................................................</td>
                                <td><input type="number" name="n_eval_logro"  value="{{$indice->n_eval_logro}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px">- EVALUACIÓN CURRICULAR .....................................................................................................................................................................</td>
                                <td><input type="number" name="n_eval_curricular" value="{{$indice->n_eval_curricular}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>REFERENCIAS BIBLIOGRÁFICAS .....................................................................................................................................................................</td>
                                <td><input type="number" name="n_referencias" value="{{$indice->n_referencias}}" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>ANEXOS ...........................................................................................................................................................................................................</td>
                                <td><input type="number" name="n_anexos" value="{{$indice->n_anexos}}" required class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <a href="{{route('home')}}" class="btn btn-default btn-block">ATRÁS</a>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-success btn-block">GUARDAR CAMBIOS</button>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="modal fade" id="info">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Información</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                    <div class="col-sm-12" align="justify">
                        <p>Los número de página se encuentran en el archivo del curriculo generado</p>
                    </div>
              </div>       
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

</div> <br>
@endsection

@section('scripts')

<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.config.height  = 400;
    CKEDITOR.replace( 'contenido' );
</script>
@endsection