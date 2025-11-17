@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Tabla de Convalidación de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Tabla de Convalidación</li>
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
                    <h2  align="center">TABLA DE CONVALIDACIÓN</h2>
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
            <div class="row">
                <div class="col-sm-2">
                   <a href="#" data-toggle="modal" data-target="#nuevo-integrante" 
                   class="btn btn-dark btn-block"><i class="fa fa-plus"></i> Nueva Asignación</a>
                </div>
               
             </div>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ciclo</th>
                        <th>Créditos</th>
                        <th>Curso Currículo 2018</th>
                        <th>Curso Currículo 2021</th>
                        <th>Créditos</th>
                        <th>Ciclo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle as $value => $item)
                        <tr>
                            <td>{{$value = $value + 1 }}</td>
                            <td>{{$item->ciclo}}</td>
                            <td>{{$item->credito}}</td>
                            <td>{{$item->nombre_curso}}</td>
                            <td>{{$item->cursos->nombre}}</td>
                            <td>{{$item->cursos->creditos}}</td>
                            <td>{{$item->cursos->ciclo}}</td>
                            <td>
                                <a href="{{route('integrante.editar', $item->id)}}"
                                    class="btn btn-warning">
                                    <i class="fa fa-edit"></i></a>
                                    <form method="POST" action="{{route('detalle.eliminar',$item->id)}}" onclick="return confirm('Estas seguro de eliminar la asignación del curso: {{ $item->nombre_curso}}')">
                                      {{ csrf_field() }}
                                     
                                          <button type="submit" class="btn  btn-danger"> <span class="fa fa-trash"></span></button>
                                                               
                                  </form>
                            </td>
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
                        <p>Aplicable para actualizaciones y rediseños curriculares, no aplica para nuevos programas
                          académicos. La tabla de equivalencias relaciona la nueva propuesta de currículo con el currículo
                          vigente. Esta(s) tabla(s) facilita(n) la elaboración de las tablas de convalidaciones.</p>
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
              <h4 class="modal-title">Nueva Asignación</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('tabla_convalidacion.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="modal-body">
              <div class="row">
                    <input type="hidden" name="id_tabla_convalidacion" value="{{$tabla_convalidacion->id}}">
                    <div class="col-sm-2">
                        <label>Ciclo: </label>
                        <select name="ciclo" class="form-control" required>
                            <option value="">---Seleccione---</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                            <option value="X">X</option>
                            @if ($programa_estudio->num_ciclos == 12 || $programa_estudio->num_ciclos == 14)
                              <option value="XI">XI</option>
                              <option value="XII">XII</option>
                            @endif
                            @if ($programa_estudio->num_ciclos == 14)
                              <option value="XIII">XIII</option>
                              <option value="XIV">XIV</option>
                          @endif
                        </select>
                    </div>
                    <div class="col-sm-2">
                      <label>Créditos: </label>
                      <input type="number" min="0" name="creditos" class="form-control" required>
                  </div>
                    <div class="col-sm-8">
                        <label>Nombre de Curso - CURRÍCULO 2018: </label>
                        <input type="text" name="nombre_curso_2018" class="form-control" required>
                    </div>
                    <div class="col-sm-12 mt-4">
                        <label for="">Nombre de Curso - CURRÍCULO 2021: </label>
                        <select name="id_curso_2021" class="form-control" required>
                            <option value="">---Seleccione---</option>
                            @foreach ($cursos as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
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
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.config.height  = 400;
    CKEDITOR.replace( 'contenido' );
</script>
@endsection