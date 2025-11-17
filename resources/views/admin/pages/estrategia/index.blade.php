@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Estrategias de Enseñanza de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Estrategias de Enseñanza</li>
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
                    <h2  align="center">ESTRATEGIAS DE ENSEÑANZA</h2>
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
            <form action="{{route('estrategia.update')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>Contenido: </label>
                        <textarea name="contenido" required>{{$estrategia->contenido}}</textarea>
                    </div>
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
                        <p>Modalidades presenciales, semipresenciales y virtuales según SUNEDU 
                            (Transcribir del MOEDUNT-2, y contextualizar según el programa de estudios)</p>
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