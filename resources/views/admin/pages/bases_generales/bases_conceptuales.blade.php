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
            <li class="breadcrumb-item active">Bases Teórico-Conceptuales</li>
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
                <div class="col-sm-4"></div>
                <div class="col-sm-4" style="background-color: #F33154; color: white; border-radius: 10px">
                    <h2  align="center">BASES TEÓRICO-CONCEPTUALES</h2>
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
            <b>3.1.3 Bases Teórico - Conceptuales</b> <br>
            <form action="{{route('base_conceptuales.update1')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>3.1.3.1 Concepción del ser humano, sociedad y cultura: </label>
                        <textarea name="concepcion_humano" required>
                            @if (is_null($base_general->concepcion_humano))
                                <b>a) Concepción de hombre</b>
                                <p style="text-align: justify">
                                    El hombre es un ser multidimensional y complejo, un todo; un ser natural-biológico, psico-espiritual
                                    y socio-histórico-cultural, y un ser emergente. En suma, es una realidad biopsicosocial y cultural
                                    que a través de largos y diversos procesos ontogenéticos (individuo), filogenéticos (especie) e
                                    históricos se ha ido construyendo y se sigue configurando personal y socialmente.<br><br>
                                    Su ser natural-biológico se refiere a lo corporal, a lo anatómico, neurofisiológico, bioquímico y
                                    genético del ser humano, su base o soporte material sobre el cual se desarrollan las demás
                                    dimensiones del hombre.<br><br>
                                    Su ser psico-espiritual corresponde a su mundo subjetivo, a su consciencia, a sus dimensiones
                                    cognitivas, afectivas y volitivas, las mismas que se expresan en distintas formas de actitudes y
                                    comportamientos.<br><br>
                                    Su ser socio-histórico-cultural comprende el ejercicio natural y necesario de la convivencia, del
                                    compartimiento de lo común, de la construcción conjunta de ideales y valores, de la creación de
                                    formas y condiciones favorables de vida para la sobrevivencia, el desarrollo personal y la conservación de 
                                    la especie. Surgen, así, las relaciones e instituciones religiosas, económicas,
                                    políticas, sociales, educativas, culturales, etc.</p>

                                <b>b) Concepción de sociedad</b>
                                <p style="text-align: justify">
                                    La sociedad es la congregación histórica y cultural de seres humanos en base al desarrollo de una
                                    serie de relaciones e interacciones en un determinado tiempo y dentro de un espacio geográfico o
                                    entorno natural. La manera en que los hombres se organizan y se relacionan, compatibilizando
                                    coincidencias y contradicciones, al interno y externo de las unidades, organizaciones e
                                    instituciones, que activan la dinámica social. Y hay sociedad, si hay historia e intereses comunes
                                    y una visión de futuro compartido.
                                    </p>

                                <b>c) Concepción de cultura</b>
                                <p style="text-align: justify">
                                    La cultura es el conjunto múltiple de productos y valores tanto materiales (instrumentos, artefactos,
                                    edificaciones, etc.) como ideales o espirituales (ciencia, filosofía, estética, religión, axiología,
                                    política, leyes, tradiciones, etc.) que han sido elaborados socio históricamente, difundidos y
                                    preservados, fundamentalmente, gracias a la educación.
                                        </p>
                            @else
                                {{$base_general->concepcion_humano}}
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
            </form> <br>
            <form action="{{route('base_conceptuales.update2')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>3.1.3.2 Concepción epistemológica: </label>
                        <textarea name="concepcion_episte" required>
                            @if (is_null($base_general->concepcion_episte))
                                <b>a) El conocimiento científico</b>
                                <p style="text-align: justify">
                                    Es un producto y proceso empírico-racional creado y recreado a partir de la investigación científica.
                                    Es el insumo fundamental en los procesos de enseñanza- aprendizaje en la educación universitaria
                                    y para el desarrollo de la ciencia y la tecnología al servicio de la humanidad. Por ello, según
                                    Romero (2010), la asimilación, difusión, creación, desarrollo, acumulación y aplicación del
                                    conocimiento científico es, quizás, la más importante tarea individual y colectiva de toda sociedad
                                    para poder desarrollarse.<br><br>
                                    El conocimiento científico, a diferencia de las otras formas de conocimiento y gracias a la
                                    rigurosidad de su método, permite al ser humano una comprensión más cabal de la realidad y de
                                    sí mismo, al agudizar sus facultades sensoriales e intelectuales para percibir, analizar, proyectar,
                                    crear y formar imágenes, símbolos y representaciones de su propia condición compleja como de
                                    la sociedad y de todas las cosas y relaciones que conforman el universo, y luego comunicarlo a
                                    otros con el fin de que el diálogo con sus semejantes confirme, niegue o modifique dichas
                                    imágenes, símbolos y representaciones y puedan ser útiles para mejorar la realidad y las
                                    condiciones de vida de los individuos y de la sociedad.<br><br>
                                    El conocimiento científico, al reconocer el dinamismo y complejidad de la realidad, articula los
                                    abordajes multidisciplinar y transdisciplinar, y axiológicamente se orienta a fortalecer los valores
                                    relacionados con la vida, la libertad, la igualdad, la responsabilidad social y el bien común.</p>
                            @else
                                {{$base_general->concepcion_episte}}
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
            </form><br>
            <form action="{{route('base_conceptuales.update3')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>3.1.3.3 Concepción curricular: </label>
                        <textarea name="concepcion_curricular" required>
                            @if (is_null($base_general->concepcion_curricular))
                                <p style="text-align: justify">El currículo es un instrumento teórico y operativo, en el cual se plasma una concepción filosófica
                                    educativa (antropológica, ontológica, mesológica y teleológica educativa), científica y técnica
                                    acerca de la educación formal en la Universidad Nacional de Trujillo. <br>
                                    Se asume un currículo integral, humanístico, flexible e histórico crítico (que forme pensamiento
                                    dialéctico, propositivo, autónomo y complejo), sociocultural (que integre a la universidad con la
                                    sociedad y sus diferentes agentes para plantear alternativas de desarrollo social y cultural),
                                    intercultural e inclusivo (que posibilite un diálogo entre culturas para revalorar la identidad regional
                                    y nacional y asumir de manera crítica y consciente los aportes científicos, culturales y tecnológicos
                                    del entorno global) y por competencias (mediante procesos complejos e idóneos de desempeño
                                    ante determinadas situaciones, comprometan la actuación e interacción de las diversas
                                    dimensiones del ser humano y contextualizado a la construcción de un proyecto de vida,
                                    comunidad y país.</p>
                            @else
                                {{$base_general->concepcion_curricular}}
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
                        <p>Constituyen el soporte filosófico, científico y técnico que le da consistencia, orientación y
                            sentido al currículo (en general, deben ser transcritos y/o adecuados de lo planteado en el
                            MOEDUNT-2, contextualizados al currículo)</p>
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
    CKEDITOR.config.height  = 200;
    CKEDITOR.replace('concepcion_humano');
    CKEDITOR.replace('concepcion_episte');
    CKEDITOR.replace('concepcion_curricular');
</script>
@endsection