@extends('admin.layouts._principal')
@section('css')
    <link rel="stylesheet" href="{{asset('css/dropify.css')}}">
@endsection
@section('titulo')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Usuarios</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
          <li class="breadcrumb-item active">Lista de Usuarios</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('contenido')
<div class="container-fluid">
    @if (session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>
    @endif
    <div class="card">
        <div class="card-header">
          <div class="row">
              <div class="col-sm-2">
                  <a href="#" data-toggle="modal" data-target="#nuevo-slider" class="btn btn-success btn-block">
                      <i class="fa fa-plus-square"></i> Nuevo Usuario</a>
              </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th class="text-center">Rol</th>
                    <th class="text-center">Contraseña</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $key => $item)
                    <tr>
                        <td>{{$key = $key + 1}}</td>
                        <td>{{ $item->apellidos }}</td>
                        <td>{{ $item->nombres }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center">{{$item->rol}}</td>
                        <td class="text-center">{{$item->pass}}</td>
                        <td>
                            @if ($item->estado == 1)
                                <span class="badge badge-success">ACTIVO</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning"> <i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->


<div class="modal fade" id="nuevo-slider">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nuevo Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('usuario.store')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
              <div class="col-sm-6">
                  <label>APELLIDOS: </label>
                  <input type="text" required name="apellidos" class="form-control">
              </div>
              <div class="col-sm-6">
                <label>NOMBRES: </label>
                <input type="text" required name="nombres" class="form-control">
              </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label>CORREO INSTITUCIONAL: </label>
                <input type="email" required name="email" class="form-control">
            </div>
            <div class="col-sm-6">
                <label>CONTRASEÑA: </label>
                <input type="password" required name="pass" class="form-control">
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
<!-- /.modal -->  

@endsection

@section('scripts')
<script src="{{asset('js/dropify.js')}}"></script>
<script>
    $('.dropify').dropify({
    messages: {
        'default': 'Cargar',
        'replace': 'Seleccione su imagen para reemplazar',
        'remove':  'Remover',
        'error':   'Ooops, ocurrio un error.'
    }
});
</script>
@endsection