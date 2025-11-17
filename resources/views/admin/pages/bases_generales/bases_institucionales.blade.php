@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Bases Generales de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Bases Institucionales</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('contenido')
<div class="container">

    <div class="card">
        <div class="card-header" style="background-color: lightgrey !important">
            <div class="row">
                <div class="col-sm-2">
                    <a href="{{route('base_general')}}" class="btn btn-primary btn-block">Bases Normativas</a>
                </div>
                <div class="col-sm-3">
                    <a href="{{route('base_instucional')}}" class="btn btn-primary btn-block">Bases de Identidad-Institucional</a>
                </div>
                <div class="col-sm-3">
                    <a href="{{route('base_conceptuales')}}" class="btn btn-primary btn-block">Bases Teórico-Conceptuales</a>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6" style="background-color: #F33154; color: white; border-radius: 10px">
                    <h2  align="center">BASES DE IDENTIDAD - INSTITUCIONAL</h2>
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
            <b>3.1.2 Bases de Identidad-Institucional </b> <br>
            <b style="margin-left: 40px">3.1.2.1 Valores de la UNT</b><br>
            <ul style="margin-left: 70px">
                <li>Verdad</li>
                <li>Justicia</li>
                <li>Excelencia</li>
                <li>Respeto</li>
                <li>Libertad</li>
                <li>Solidaridad</li>
                <li>Responsabilidad</li>
                <li>Integridad</li>
            </ul>
            <b style="margin-left: 40px">3.1.2.2 Principios de la UNT</b>
            <p style="margin-left: 90px">La UNT asume los principios establecidos en la ley universitaria
                30220 y, además, enarbola los siguientes principios
                institucionales:</p>
                <ol type="a" style="margin-left: 70px">
                   <li> Búsqueda, cultivo y difusión de la verdad.</li>
                    <li> Ejercicio pleno y racional de la autonomía.</li>
                    <li> Desarrollo de la sensibilidad y el compromiso social.</li>
                    <li> Cultivo del espíritu creativo, crítico, innovador e investigativo.</li>
                    <li> Respeto al interés superior del estudiante.</li>
                    <li> Valoración plena a la vida humana en su diversidad cultural. </li>
                    <li> Práctica y mejoramiento continuo de la calidad académica.</li>
                    <li> Ejercicio de una ética pública, profesional y de respeto al bien común.</li>
                </ol>
            <b style="margin-left: 40px">3.1.2.3 Misión de la UNT</b>
            <p style="margin-left: 90px">Formar profesionales e investigadores de la región norte y el país, con ética y calidad; creadores
            de conocimiento científico, tecnológico, humanístico e innovación, para el desarrollo sostenible de
            la sociedad.</p>
            <b style="margin-left: 40px">3.1.2.4 Visión de la UNT</b>
            <p style="margin-left: 90px">Al 2024, la Universidad Nacional de Trujillo es una de las líderes en excelencia académica y
            producción científica con visibilidad e impacto en Latinoamérica y el mundo.</p>
            
            <form action="{{route('base_institucional.update1')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <b style="margin-left: 40px">3.1.2.5 Misión de la Facultad (Opcional)</b>
                        <textarea name="bi_fac_mision" required>{{$base_general->bi_fac_mision}}</textarea>
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

            <form action="{{route('base_institucional.update1')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label><b style="margin-left: 40px">3.1.2.6 Visión de la Facultad (Opcional)</b>: </label>
                        <textarea name="bi_fac_vision" required>{{$base_general->bi_fac_vision}}</textarea>
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
         <br>
            <form action="{{route('base_institucional.update2')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>   <b style="margin-left: 40px">3.1.2.7 Misión del Programa Profesional (OPCIONAL)</b> </label>
                        <textarea name="bi_men_mision" required>{{$base_general->bi_men_mision}}</textarea>
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
            <br>
            <form action="{{route('base_institucional.update2')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label><b style="margin-left: 40px">3.1.2.8 Visión del Programa Profesional (OPCIONAL)</b> </label>
                        <textarea name="bi_men_vision" required>{{$base_general->bi_men_vision}}</textarea>
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
                        <p>(Deben ser transcritas y/o adecuadas del MOEDUNT-2 y, además, pueden incluirse las que
                            se consideren propias de la Facultad y, de ser necesario, hasta del propio programa
                            profesional)
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

</div> <br>
@endsection

@section('scripts')

<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.config.height  = 150;
    CKEDITOR.replace( 'bi_fac_mision' );
    CKEDITOR.replace( 'bi_fac_vision' );
    CKEDITOR.replace('bi_men_mision');
    CKEDITOR.replace('bi_men_vision');
    CKEDITOR.replace('bi_principios_facultad');
</script>
@endsection