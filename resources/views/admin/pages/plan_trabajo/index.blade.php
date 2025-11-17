@extends('admin.layouts._principal')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dropify.css')}}">
@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Datos de plan de trabajo de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Plan de Trabajo</li>
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
              @if (auth()->user()->rol == 'coteccu' || auth()->user()->rol == 'admin')
                  
              
                <div class="col-sm-4  mt-3 text-center">
                  @if (is_null($plan_trabajo->observacion) && $plan_trabajo->conformidad == 'SI')
                  <h6><b style="
                    background-color: rgb(56, 201, 102);
                    padding: 10px;
                    border-radius: 10px;">APROBADO</b></h6>
                  @endif
                  @if (is_null($plan_trabajo->observacion) && is_null($plan_trabajo->conformidad))
                      <h6><b style="
                        background-color: yellow;
                        padding: 10px;
                        border-radius: 10px;">AUN NO SE VALIDÓ</b></h6>
                  @endif
                  @if (!is_null($plan_trabajo->observacion) && $plan_trabajo->conformidad == 'NO')
                    <h6><b style="
                      background-color: rgb(255, 0, 0);
                      padding: 10px;
                      border-radius: 10px;">CORREGIR   <a type="button" href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#detalle" ><i class="fa fa-eye"></i></a></b></h6>
                  @endif
                </div>
                @else
                <div class="col-sm-4 mt-3 text-center">
                    @if (is_null($plan_trabajo->observacion) && is_null($plan_trabajo->conformidad))
                      <a type="button" href="#" class="btn btn-success" data-toggle="modal" data-target="#validar" >VALIDAR</a>
                    @else
                       @if ($plan_trabajo->conformidad == 'SI')
                       <h6><b style="
                        background-color: rgb(56, 201, 102);
                        padding: 10px;
                        border-radius: 10px;">SE ENVIÓ LA CONFORMIDAD</b></h6>
                       @else
                       <h6><b style="
                        background-color: yellow;
                        padding: 10px;
                        border-radius: 10px;">SE ENVIÓ CORRECCIÓN</b></h6>
                       @endif
                    @endif
                </div>
                @endif
                <div class="col-sm-4" style="background-color: #F33154; color: white; border-radius: 10px">
                    <h2  align="center">Plan Trabajo</h2>
                </div>
                <div class="col-sm-2">
                
                </div>
                <div class="col-sm-1" align="center">
                    @if (count($integrantes)>1 && !is_null($plan_trabajo->facultad) &&  !is_null($plan_trabajo->nro_resolucion))
                    <a href="{{route('plan.trabajo.pdf')}}" target="_blank" class="btn btn-danger btn-block">
                        <i class="fa fa-file-pdf"></i>  PDF
                     </a>
                    @endif
                   
                </div>
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
            <form action="{{route('plan.trabajo.update')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                   <div class="col-sm-6">
                       <label for="">Facultad: </label>
                       <input type="text" name="facultad" required class="form-control" value="{{$plan_trabajo->facultad}}">
                   </div>
                   <div class="col-sm-6">
                        <label for="">N° Resolución de Constitución de Coteccus: </label>
                        <input type="text" name="nro_resolucion" required class="form-control" value="{{$plan_trabajo->nro_resolucion}}">
                   </div>
                   <div class="col-sm-12 mt-2">
                    <label for="">Contextualización de justificación: <a href="#" data-toggle="modal" data-target="#justificacion" >Ver justificación</a> </label>
                    <textarea name="contextualizacion" required>{{$plan_trabajo->contextualizacion}}</textarea>
                    </div>

                    <div class="col-sm-4 mt-2 text-center">
                        <label for="">  @if (!is_null($plan_trabajo->resolucion))Reemplazar el Archivo:@else Cargar el Archivo: @endif Resolución de constitución de COTECCU: </label>
                        @if (!is_null($plan_trabajo->resolucion))
                          <a href="{{asset('./resoluciones/'.$plan_trabajo->resolucion)}}" target="_blank"><img width="30%" src="{{asset('./pdf.png')}}" alt="pdf"></a>
                        @endif
                        <input type="file" class="form-control mt-2" accept="application/pdf" name="resolucion">
                    </div>
                    <div class="col-sm-4 mt-2 text-center">
                      <label for="">@if (!is_null($plan_trabajo->acta_aprobacion))Reemplazar el Archivo:@else Cargar el Archivo: @endif  Acta de aprobación del plan de trabajo por parte del COTECCU: </label>
                      @if (!is_null($plan_trabajo->acta_aprobacion))
                      <a href="{{asset('./actas/'.$plan_trabajo->acta_aprobacion)}}" target="_blank"><img width="30%" src="{{asset('./pdf.png')}}" alt="pdf"></a>
                    @endif
                      <input type="file" class="form-control mt-2" accept="application/pdf" name="acta_aprobacion">
                    </div>
                    <div class="col-sm-4 mt-2 text-center">
                      <label for=""> @if (!is_null($plan_trabajo->evidencias))Reemplazar el Archivo:@else Cargar el Archivo: @endif Evidencias de reunión (enlaces, fotografías y otros): </label>
                      @if (!is_null($plan_trabajo->evidencias))
                      <a href="{{asset('./evidencias/'.$plan_trabajo->evidencias)}}" target="_blank"><img width="30%" src="{{asset('./pdf.png')}}" alt="pdf"></a>
                    @endif
                      <input type="file" class="form-control mt-2" accept="application/pdf" name="evidencias">
                    </div>

                    <div class="col-sm-4 mt-2"></div>
                   <div class="col-sm-4 mt-2">
                       <label for="" style="color: white">.</label>
                       @if (auth()->user()->rol == 'coteccu' || auth()->user()->rol == 'admin')
                           
                        <button class="btn btn-success btn-block">GUARDAR CAMBIOS</button>
                       @endif

                   </div>
                   <div class="col-sm-4 mt-2"></div>
                </div>
                <br>
            </form>
            
            <hr>

            <br>
            <div class="row">
              @if (auth()->user()->rol == 'coteccu' || auth()->user()->rol == 'admin')
                <div class="col-sm-2">
                   <a href="#" data-toggle="modal" data-target="#nuevo-integrante" 
                   class="btn btn-dark btn-block"><i class="fa fa-plus"></i> Nuevo Integrante</a>
                </div>
               @endif
             </div>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Integrante</th>
                        <th>Cargo</th>
                        <th>Firma</th>
                        @if (auth()->user()->rol == 'coteccu' || auth()->user()->rol == 'admin')
                        <th>Opciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($integrantes as $value => $item)
                        <tr>
                            <td>{{$value = $value + 1 }}</td>
                            <td>{{$item->apellido}} {{$item->nombre}}</td>
                            <td>{{$item->cargo}}</td>
                            <td> <img src="{{asset( '/firmas/'.$item->firma ) }}" alt="firma" width="100px"></td>
                            @if (auth()->user()->rol == 'coteccu' || auth()->user()->rol == 'admin')
                            <td>
                                <a href="{{route('integrante.editar', $item->id)}}"
                                    class="btn btn-warning">
                                    <i class="fa fa-edit"></i></a>
                                    <form method="POST" action="{{route('integrante.eliminar',$item->id)}}" onclick="return confirm('Estas seguro de eliminar el participante {{ $item->apellido }} {{$item->nombre}}')">
                                      {{ csrf_field() }}
                                     
                                          <button type="submit" class="btn  btn-danger"> <span class="fa fa-trash"></span></button>
                                                               
                                  </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
              </table>
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
                        <p>Ingrese los campos solicitados, todos ellos son obligatorios excepto la sección de contextualización que es opcional</p>
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

    <div class="modal fade" id="detalle">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Corregir lo siguiente: </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                  <div class="col-sm-12" align="justify">
                      <p>{{$plan_trabajo->observacion}}</p>
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

      <div class="modal fade" id="justificacion">
        <div class="modal-dialog modal-lg">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Justificación</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                    <div class="col-sm-12" align="justify">
                        <p>La Universidad para responder a los retos actuales que le plantea la sociedad, debe innovarse académicamente realizando constantes reformas curriculares con el propósito de adecuarse a los retos que la sociedad le impone, planificando adecuada y oportunamente.  <br><br>

                            La Dirección de desarrollo académico de la Universidad Nacional de Trujillo, tras un proceso de auditoría curricular realizado en julio del 2020, decidió en coordinación con el Vicerrectorado Académico y la Alta Dirección, iniciar un proceso de Reforma Curricular, en razón a lo diagnosticado y a las nuevas políticas generales de gestión académica. Por tal motivo, este proceso empezó con la actualización del Modelo Educativo y la elaboración del nuevo diseño de los Estudios Generales, los cuales son instrumentos normativos fundamentales para la Reforma curricular. <br> <br>

                            Tras culminarse estos instrumentos, a fines de abril de 2021, la Alta Dirección dispuso que se iniciase la Reforma curricular en una primera etapa en dos Facultades piloto: Educación y Derecho, con diez (10) Programas de estudio, cuya implementación y ejecución se encuentra en desarrollo en el presente semestre. <br><br>

                            Por tales razones, es menester empezar a implementar la segunda etapa de la reforma curricular con los 35 Programas de estudio faltantes en pregrado. Es fundamental culminar la reforma curricular porque ello permitirá no solo cumplir con lo dispuesto en la ley universitaria sino actualizar este instrumento de formación profesional con las nuevas políticas generales de gestión académica y a las condiciones tecnológicas derivadas del proceso pandémico.
                            </p>
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


      <div class="modal fade" id="nuevo-integrante">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nuevo Integrante</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('plan.trabajo.store.integrante')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="modal-body">
              <div class="row">
                    <input type="hidden" name="id_plan_trabajo" value="{{$plan_trabajo->id}}">
                    <div class="col-sm-6">
                        <label>Apellido del Integrante: </label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                    <div class="col-sm-6">
                      <label>Nombre del Integrante: </label>
                      <input type="text" name="nombre" class="form-control" required>
                  </div>
                    <div class="col-sm-12">
                        <label>Cargo: </label>
                        <input type="text" name="cargo" class="form-control" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="">Firma: </label>
                        <input type="file" class="dropify" data-height="200" required
                        data-allowed-file-extensions="jpg png jpeg" name="firma" />
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

      <div class="modal fade" id="validar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Validar Plan de Trabajo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('plan.trabajo.validar')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="modal-body">
              <div class="row">
                    <input type="hidden" name="id_plan_trabajo" value="{{$plan_trabajo->id}}">
                    <div class="col-sm-12">
                      <label for="">LA INFORMACIÓN INGRESADA ES VÁLIDA: </label>
                      <select name="conformidad" id="conformidad" required class="form-control" onchange="validarChange(this.value)">
                        <option value="">--Seleccione--</option>
                        <option  value="SI">SI</option>
                        <option  value="NO">NO</option>
                      </select>
                    </div>        
                    <div class="col-sm-12" id="observacion">
                      <label for="">DETALLE DE LA OBSERVACIÓN: </label>
                      <textarea name="observacion" disabled class="form-control" cols="30" rows="10" id="obs"></textarea>
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
      
</div> <br>
@endsection

@section('scripts')

<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="{{ asset('js/dropify.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.config.height  = 100;
    CKEDITOR.replace( 'contextualizacion' );

</script>
<script type="text/javascript" src="{{ asset('js/dropify.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.dropify').dropify({
                messages: {
                    'default': 'Arraste o haga click',
                    'replace': 'Arraste o haga click para reemplazar',
                    'remove':  'Remover',
                    'error':   'Ooops, ocurrió algo inesperado.'
                },
                error: {
                    'fileSize': 'El archivo pesa demasiado .',
                    'imageFormat': 'El formato de la imagen no esta permitida (png,jpg,jpeg).'
                }
            });
		});
	</script>
  <script  type="text/javascript">
    function validarChange(val){
        if (val == 'NO') {
           //document.getElementById("precio_oferta").disabled = true;
           $("#observacion").find("*").prop('disabled', false); 
           document.getElementById('obs').required = true;
        }else{
            $("#observacion").find("*").prop('disabled', true);
            document.getElementById("obs").value = "";
            document.getElementById('obs').required = false;
        }
    }
</script>
@endsection