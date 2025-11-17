@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Programa de Estudios</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Programas de Estudios</li>
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
            <a href="#" data-toggle="modal" data-target="#nuevo-programa" 
                class="btn btn-success">Nuevo Programa</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Facultad</th>
                    <th>Nombre Programa</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Número de Ciclos</th>
                    <th>Supervisor</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($programas_estudios as $value => $item)
                   <tr>
                       <td>{{$value = $value + 1}}</td>
                       <td>{{$item->facultad->nombre_facultad}}</td>
                       <td>{{$item->nombre_programa}}</td>
                       <td>{{$item->user->email}}</td>
                       <td>{{$item->user->pass}}</td>
                       <td>{{$item->num_ciclos}}</td>
                       <td>{{$item->supervisor->persona}}</td>
                       
                       <td>
                           <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                           <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                       </td>
                   </tr>
               @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div class="modal fade" id="nuevo-programa">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Programa de Estudios</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('programa.estudios.store')}}" method="POST">
            {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
                <div class="col-sm-6">
                    <label>Usuario: </label>
                    <input type="text" class="form-control" name="email" required>
                </div>
                <div class="col-sm-6">
                    <label>Contraseña: </label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="col-sm-12">
                  <label for="">Nombre de Presidente: </label>
                  <input type="text" name="persona" class="form-control" required>
                </div>
                <div class="col-sm-12">
                  <label for="">Facultad</label>
                  <select name="id_facultad" id="" class="form-control" required>
                    <option value="">--Seleccione--</option>
                    @foreach ($facultades as $row)
                        <option value="{{$row->id}}">{{$row->nombre_facultad}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-9">
                    <label>Nombre del Programa: </label>
                    <input type="text" class="form-control" name="nombre_programa" required>
                </div>
                <div class="col-sm-3">
                    <label>Número de Ciclos: </label>
                    <input type="number" class="form-control" name="num_ciclos" required>
                </div>
                <br><br>
                <hr style="background-color: red">
                <div class="col-sm-6 mt-5">
                  <label>Usuario Supervisor: </label>
                  <input type="text" class="form-control" name="email2" required>
              </div>
              <div class="col-sm-6 mt-5">
                  <label>Contraseña: </label>
                  <input type="password" class="form-control" name="password2" required>
              </div>
              <div class="col-sm-12">
                <label for="">Nombre de supervisor: </label>
                <input type="text" name="persona2" class="form-control" required>
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
@endsection

@section('scripts')
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
@endsection