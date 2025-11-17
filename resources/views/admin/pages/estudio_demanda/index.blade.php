@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Estudio de la demanda social y el Mercado laboral de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Estudio de demanda y mercado</li>
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
                <div class="col-sm-3"></div>
                <div class="col-sm-6" style="background-color: #F33154; color: white; border-radius: 10px">
                    <h2  align="center">Estudio de la demanda social y el Mercado laboral</h2>
                </div>
                <div class="col-sm-2"></div>
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
            <form action="{{route('estudio_demanda.update')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>2.1.	Determinación y justificación del ámbito de influencia del programa: </label>
                        <textarea name="influencia_programa" required>{{$estudio_demanda->influencia_programa}}</textarea>
                    </div>
                    <div class="col-sm-12">
                        <label>2.2.	Resultados de la demanda laboral profesional: </label>
                        <textarea name="laboral_profesional" required>{{$estudio_demanda->laboral_profesional}}</textarea>
                    </div>
                    <div class="col-sm-12">
                        <label>2.3.	Resultados de la demanda formativa y oferta formativa similar existente 
                            en el ámbito de influencia y su impacto en el ámbito laboral de los egresados del programa: </label>
                        <textarea name="demanda_formativa" required>{{$estudio_demanda->demanda_formativa}}</textarea>
                    </div>
                    <div class="col-sm-12">
                        <label>2.4.	Justificación de la pertinencia social, cultural o académica de la propuesta 
                            (o pertinencia con las políticas nacionales, internacionales o regionales): </label>
                        <textarea name="pertinencia_social" required>{{$estudio_demanda->pertinencia_social}}</textarea>
                    </div>
                    <div class="col-sm-12">
                        <label>2.5.	Características y justificación de las modalidades de estudio: </label>
                        <textarea name="modalidades_estudio" required>{{$estudio_demanda->modalidades_estudio}}</textarea>
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
                        <p>A solicitud de SUNEDU para otorgar la semi presencialidad</p>
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
    CKEDITOR.config.height  = 150;
    CKEDITOR.replace('influencia_programa');
    CKEDITOR.replace('laboral_profesional');
    CKEDITOR.replace('demanda_formativa');
    CKEDITOR.replace('pertinencia_social');
    CKEDITOR.replace('modalidades_estudio');
</script>
@endsection