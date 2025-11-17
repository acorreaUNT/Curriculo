@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Lista de competencias</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item"><a href="{{route('competencias')}}">Competencias</a></li>
            <li class="breadcrumb-item active">Listado de Competencias</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('contenido')
<div class="container">
    <div class="card">
        <div class="card-header" style="background-color: aquamarine">
         <div class="row">
             <div class="col-sm-8">
                <h2><b>{{$tipo->nombre}}</b></h2> 
             </div>
             <div class="col-sm-2">
              <a href="{{route('articulacion', encrypt($tipo->id))}}" class="btn btn-primary btn-block">Articulación</a>
           </div>
           @if ($tipo->id !== 1)
             <div class="col-sm-2">
                <a href="#" data-toggle="modal" data-target="#nueva-competencia" 
                class="btn btn-success btn-block">Nueva Competencia</a>
             </div>
             @endif
            
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competencias as $value => $item)
                    <tr>
                        <td>{{$value = $value + 1 }}</td>
                        <td>{{$item->codigo}}</td>
                        <td>{{$item->contenido}}</td>
                        <td class="text-center">
                          @if ($item->id_tipo_competencia !== 1) <!--Es 1 -->
                          <a href="#" data-toggle="modal" data-target="#nueva-capacidad{{$item->id}}"
                            class="btn btn-primary btn-block">
                            <i class="fa fa-indent"></i> Registrar Capacidad</a>
                          
                           
                                <a href="#" data-toggle="modal" data-target="#editar{{$item->id}}" 
                                  class="btn btn-warning btn-block">
                                  <i class="fa fa-edit"></i> </a>

                                @endif
                                <a href="#" data-toggle="modal" data-target="#capacidades{{$item->id}}" 
                                  class="btn btn-dark btn-block">
                                  <i class="fa fa-eye"></i> </a>
                                  @if ($item->id_tipo_competencia !== 1)
                                      
                                 
                                  <form method="POST" action="{{route('competencia.eliminar',$item->id)}}" 
                                    onclick="return confirm('¿Estas seguro de eliminar la competencia?, si tiene capacidades registradas serán eliminadas también')">
                                    {{ csrf_field() }}
                                        <button type="submit" class=" mt-2 btn btn-block btn-danger"> <i class="fa fa-trash"> </i></button>           
                                  </form>
                                  @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>   
</div>

<div class="modal fade" id="nueva-competencia">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nueva Competencia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('competencia.store')}}" method="POST">
          {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
              <input type="hidden" name="id_programa_estudios" value="{{$programa_estudio->id}}">
              <input type="hidden" name="id_tipo_competencia" value="{{$tipo->id}}">
              <div class="col-sm-12">
                <label>Codigo: </label>
                <input type="text" name="codigo" placeholder="E#" class="form-control" required>
            </div>
              <div class="col-sm-12">
                  <label>Contenido: </label>
                  <textarea name="contenido" class="form-control" cols="30" rows="10" required></textarea>
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

@foreach ($competencias as $itemx)
<div class="modal fade" id="editar{{$itemx->id}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Competencia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('competencia.update',$itemx->id)}}" method="POST">
          {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
              <div class="col-sm-12">
                <label>Codigo: </label>
                <input type="text" name="codigo" placeholder="E#" class="form-control" value="{{$itemx->codigo}}" required>
            </div>
              <div class="col-sm-12">
                  <label>Contenido: </label>
                  <textarea name="contenido" class="form-control" cols="30" rows="10" required>{{$itemx->contenido}}</textarea>
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
@endforeach

@foreach ($competencias as $item2)
<div class="modal fade" id="nueva-capacidad{{$item2->id}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nueva Capacidad</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('capacidad.store')}}" method="POST">
          {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
              <input type="hidden" name="id_competencia" value="{{$item2->id}}">
              <label>Codigo: </label>
              <input type="text" name="codigo" placeholder="E#.0#" class="form-control" required>
              <div class="col-sm-12">
                  <label>Contenido: </label>
                  <textarea name="contenido" class="form-control" cols="30" rows="10" required></textarea>
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
@endforeach


@foreach ($competencias as $row)
<?php $capacidades = \App\Models\Capacidades::where('id_competencia', $row->id)->get() ?>
<div class="modal fade" id="capacidades{{$row->id}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Lista de Capacidades</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
              <table  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Descripcion</th>
                    @if ($row->id_tipo_competencia !== 1)
                    <th>Opciones</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach ($capacidades as $value2 => $row2)
                      <tr>
                        <td>{{$value2 = $value2 + 1 }}</td>
                        <td>{{$row2->codigo}}</td>
                        <td>{{$row2->contenido}}</td>
                        @if ($row2->competencia->id_tipo_competencia !== 1)
                        <td>
                          <form method="POST" action="{{route('capacidad.eliminar',$row2->id)}}" 
                            onclick="return confirm('Estas seguro de eliminar esta capacidad')">
                            {{ csrf_field() }}
                                <button type="submit" class="btn btn-block btn-danger"> <i class="fa fa-trash"> </i></button>           
                          </form>
                        </td>
                        @endif
                      </tr>
                  @endforeach
                </tbody>
              </table>
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
@endforeach

@endsection

@section('scripts')
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
@endsection