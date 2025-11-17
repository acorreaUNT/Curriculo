@extends('admin.layouts._principal')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dropify.css')}}">
@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Usuario: {{$user->persona}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel de Control</a></li>
            <li class="breadcrumb-item active">Editar Usuario</li>
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
                    <h2  align="center">Editar Usuario</h2>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-1" align="center">
                    
                   
                </div>
                <div class="col-sm-1">
                    <a href="#" data-toggle="modal" data-target="#info" 
                         class="btn btn-block btn-info"><i class="fa fa-question"></i></a>
                </div>
            </div>
        </div>
        @if (session('mensaje'))
            <div class="alert alert-dark alert-dismissible fade show">{{ session('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>
        @endif
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{route('update.usuario')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <input type="hidden" name="id" value="{{$user->id}}">
                  <div class="col-sm-12">
                    <label>Nombres: </label>
                    <input type="text" name="persona" class="form-control" value="{{$user->persona}}" required>
                </div>
                <div class="col-sm-6">
                  <label>Contraseña Actual: </label>
                  <input type="password" name="pass_actual" class="form-control" required>
                </div>
                <div class="col-sm-6">
                    <label>Nueva Contraseña: </label>
                    <input type="password" name="pass_nueva" class="form-control" required>
                  </div>


                    <div class="col-sm-4"></div>
                    <div class="col-sm-2">
                      <label for="" >.</label>
                       <a type="button" href="{{route('home')}}" class="btn btn-default btn-block">ATRÁS</a>
                  </div>
                   <div class="col-sm-2">
                       <label for="" style="color: white">.</label>
                        <button class="btn btn-success btn-block">GUARDAR CAMBIOS</button>
                   </div>
                   <div class="col-sm-4"></div>
                </div>
                <br>
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
                        <p>Puede editar ingresando los campos solicitados</p>
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
@endsection