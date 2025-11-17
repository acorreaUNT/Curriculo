@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Ejes Curriculares de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Eje Curricular</li>
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
                    <h2  align="center">EJE CURRICULAR</h2>
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
            <form action="{{route('eje_curricular.update')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>4.1 Responsabilidad social universitaria: </label>
                        <textarea name="responsabilidad_social" required>
                            @if (is_null($eje_curricular->responsabilidad_social))
                            <p style="text-align: justify">Este eje permitirá cumplir con las funciones básicas de la UNT, mencionadas anteriormente. 
                                La responsabilidad social es el compromiso ético que tiene la UNT, en dos sentidos:</p>
                            <ol type="a">
                                <li>El fomento de las relaciones interpersonales adecuadas entre sus miembros,
                                     el clima institucional y organizacional, una gestión democrática, una política 
                                     académica humanista e integradora y una política de preservación del medio ambiental.</li>
                                <li>La interacción con el entorno para propiciar el desarrollo de la comunidad y del país,
                                     asumiendo un compromiso institucional efectivo, con la puesta en marcha de todo el 
                                     aparato organizativo y académico (docentes, estudiantes, comunidad universitaria), 
                                     para promover el desarrollo social sostenible del entorno regional y nacional.</li>
                            </ol>                            
                            @else
                                {{$eje_curricular->responsabilidad_social}}
                            @endif
                            
                        </textarea>
                    </div>

                    <div class="col-sm-12">
                        <label>4.2 Investigación formativa: </label>
                        <textarea name="investigacion_formativa" required>
                            @if (is_null($eje_curricular->investigacion_formativa))
                            <p style="text-align: justify">Es una estrategia didáctica de enseñanza-aprendizaje por la cual 
                                los estudiantes en las asignaturas irán desarrollando sus competencias y capacidades investigativas
                                 de modo permanente, teniendo como propósito el fortalecimiento de la rigurosidad académica universitaria
                                 y la actitud científica.
                                </p>                          
                            @else
                                {{$eje_curricular->investigacion_formativa}}
                            @endif
                            
                        </textarea>
                    </div>

                    <div class="col-sm-12">
                        <label>4.3 I+D+i (investigación + desarrollo + innovación): </label>
                        <textarea name="idi" required>
                            @if (is_null($eje_curricular->idi))
                            <p style="text-align: justify">La investigación científica es el proceso necesario para crear conocimiento científico; 
                                la innovación, el uso de ese conocimiento para, a través de la tecnología, generar bienestar en la sociedad. Su 
                                adecuada y oportuna articulación generan desarrollo. Es, entonces, este eje curricular fundamental para impulsar 
                                planes de desarrollo sostenible de la región y del país, así como del contexto internacional; por eso está muy ligado 
                                con el modelo de responsabilidad social de la UNT.                                
                                </p>                          
                            @else
                                {{$eje_curricular->idi}}
                            @endif
                            
                        </textarea>
                    </div>

                    <div class="col-sm-12">
                        <label>4.4 Sostenibilidad ambiental: </label>
                        <textarea name="sostenibilidad_ambiental" required>
                            @if (is_null($eje_curricular->sostenibilidad_ambiental))
                            <p style="text-align: justify">Este eje permitirá desarrollar la conciencia y responsabilidad ambiental
                                 en vista a los graves problemas que aquejan al planeta. Por ende, el currículo debe considerar 
                                 actividades, proyectos y estrategias didácticas que permitan el cuidado, la prevención y el tratamiento
                                  de los problemas ambientales locales, regionales y nacionales con alternativas de solución.                             
                                </p>                          
                            @else
                                {{$eje_curricular->sostenibilidad_ambiental}}
                            @endif
                            
                        </textarea>
                    </div>

                    <div class="col-sm-12">
                        <label>4.5 Ética y ciudadanía: </label>
                        <textarea name="etica" required>
                            @if (is_null($eje_curricular->etica))
                            <p style="text-align: justify">Con este eje se propone el diseño de actividades y experiencias académicas, que 
                                le permitirán al futuro profesional, tener competencias y virtudes morales personales para el bien común
                                 y que desde su profesión contribuyan responsablemente en la construcción de una sociedad libre, democrática, 
                                 justa, pacífica y feliz.                            
                                </p>                          
                            @else
                                {{$eje_curricular->etica}}
                            @endif
                            
                        </textarea>
                    </div>

                    <div class="col-sm-12">
                        <label>4.6 Identidad, interculturalidad e inclusividad: </label>
                        <textarea name="identidad" required>
                            @if (is_null($eje_curricular->identidad))
                            <p style="text-align: justify">La interrelación de los aprendizajes de los estudiantes con la realidad local y global, 
                                a partir de un análisis crítico, pluralista y tolerante, es importante para forjar su conciencia identitaria 
                                e histórica, y así contribuir a la revaloración en la diversidad y a su desarrollo inclusivo e integrador, 
                                donde todos los peruanos se vean iguales y con el mismo valor. El énfasis está en orientar, respecto a la 
                                formación de los futuros profesionales, dentro de una concepción igualitaria de oportunidades, a la atención 
                                que se debe brindar a las poblaciones vulnerables y a las personas con habilidades diferentes.                              
                                </p>                          
                            @else
                                {{$eje_curricular->identidad}}
                            @endif
                            
                        </textarea>
                    </div>

                    <div class="col-sm-12">
                        <label>4.7 Multidisciplinariedad e interdisciplinariedad: </label>
                        <textarea name="multidisciplinaria" required>
                            @if (is_null($eje_curricular->multidisciplinaria))
                            <p style="text-align: justify">
                                Se propicia, desde este eje, la formación de profesionales que enfrenten problemas complejos desde una
                                 perspectiva inter y multidisciplinaria, considerando la importancia del trabajo en equipo, el aprendizaje
                                  colaborativo y el enfoque integral del análisis de los problemas del conocimiento y de aquellos que se
                                   plantean en la sociedad. <br>
                                   Las asignaturas multidisciplinarias serán impartidas con docentes invitados de diferentes
                                    disciplinas y sobre la base de un conocimiento común. En cambio, las asignaturas interdisciplinarias 
                                    se realizarán con varios especialistas, al mismo tiempo, de disciplinas diferentes para abordar didácticamente 
                                    temáticas complejas siendo normado en un Reglamento especial.
                                </p>                          
                            @else
                                {{$eje_curricular->multidisciplinaria}}
                            @endif
                            
                        </textarea>
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
                        <p>Transcribir del MOEDUNT-2, y contextualizar</p>
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
    CKEDITOR.replace('responsabilidad_social');
    CKEDITOR.replace('investigacion_formativa');
    CKEDITOR.replace('idi');
    CKEDITOR.replace('sostenibilidad_ambiental');
    CKEDITOR.replace('etica');
    CKEDITOR.replace('identidad');
    CKEDITOR.replace('multidisciplinaria');
</script>
@endsection