@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Sistema de Evaluación de : {{$programa_estudio->nombre_programa}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Sistema de Evaluación</li>
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
                    <h2  align="center">SISTEMA DE EVALUACIÓN</h2>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-1">
                    <a href="#" data-toggle="modal" data-target="#lineamiento" 
                         class="btn btn-block btn-dark"><i class="fa fa-eye"></i></a>
                </div>
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
            <form action="{{route('sistema_evaluacion.update')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <label>Contextualizar: </label>
                        <textarea name="contenido" required>{{$sistema_evaluacion->contenido}}</textarea>
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
                        <p>Contextualizar según sea conveniente</p>
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

    <div class="modal fade" id="lineamiento">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Sistema de Evaluación</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                    <div class="col-sm-12" align="justify">
                        <b>13. SISTEMA DE EVALUACIÓN</b> <br>
            <b>13.1. La evaluación de los aprendizajes </b>
            <p class="margen">Es un componente fundamental del proceso de enseñanza aprendizaje, es continuo y permanente y debe permitir
                analizar el logro de competencias para alcanzar el perfil de egreso. Por ello, se puede diseñar que sea mediante
                autoevaluación (del estudiante), coevaluación (entre pares) y heteroevaluación (del docente al estudiante), de tipo
                diagnóstico, formativa o sumativa.<br><br>
                Según el enfoque de competencias asumido por la UNT, se recomienda usar principalmente la evaluación formativa
                para cualesquiera de las modalidades y niveles de estudio.  </p>

            <div class="margen2"><b>13.1.1 Sobre los principios que fundamentan la evaluación de los aprendizajes </b></div>
            <p class="margen3"><b>a) Dinámico y continuo:</b> Es un proceso que debe desarrollarse en todo el proceso de formación profesional en
                el cual participan todos los sujetos del currículo: docentes, estudiantes, la Institución y la Comunidad. <br><br>
                <b>b) Perfectibilidad:</b> Sirve para la toma de decisiones e implementación de los planes de mejora y de
                retroalimentación <br><br>
                <b>c) Integralidad:</b> Se valora tanto el proceso cuanto los resultados de los aprendizajes, así como lo cuantitativo y
                lo cualitativo. <br><br>
                <b>d) Pertinente y situado:</b> De be ser acorde al área o disciplina, a las capacidades y competencias y basado
                estrictamente en la realidad. <br><br>
                <b>e) Objetividad:</b>  La evaluación debe estar acorde a los resultados de aprendizaje y capacidades, los criterios de
                evaluación deben ser conocidos por los estudiantes, debe ser rigurosa, técnicamente bien diseñada e
                imparcial </p>

            <div class="margen2"><b>13.1.2 Sobre la planificación de la evaluación </b></div>
            <p class="margen3">Los docentes deberán diseñar sus instrumentos de evaluación en función a las capacidades y competencias a
                lograr, teniendo en cuenta los criterios de evaluación, los indicadores de evaluación, la seguridad, objetividad y
                respeto al estudiante, todo conforme a las diversas modalidades y niveles de estudio.</p>

             <div class="margen2"><b>13.1.3 Sobre las técnicas e instrumentos de evaluación</b></div>
            <p class="margen3">En el enfoque por competencias, las estrategias, técnicas e instrumentos de evaluación deben tener como
                finalidad el aprendizaje de los estudiantes, ello supone que tanto los docentes como los estudiantes aprendan
                de los resultados. En efecto, los docentes en el proceso de evaluación pueden mejorar su enseñanza
                adaptándose a los intereses y necesidades de aprendizaje de sus estudiantes. Ello puede hacerse más efectivo
                con la ayuda de las herramientas digitales. Se sugiere usar las siguientes técnicas e instrumentos de evaluación: <br> <br>
                <b>a) Técnica de observación:</b> guía de observación, registro anecdótico, diario de clase, diario de trabajo, escala
                de actitudes y otros. <br><br>
                <b>b) Técnica de análisis de desempeño de los estudiantes:</b> preguntas sobre el procedimiento, cuadernos de
                los estudiantes, organizadores gráficos, portafolio, rúbrica, lista de cotejo y otros. <br><br>
                <b>c) Técnica de interrogatorio:</b>
                <ul class="margen3">
                    <li>Textuales: debate y ensayo</li>
                    <li>Pruebas orales o escritas.</li>
                </ul></p>
                <div class="row" style="align-content: center; margin-top: 10px" >
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6" style="border: 1px solid black; border-radius; align-content: center; margin-left: 150px">
                        <p><b>La nota mínima aprobatoria en la UNT es de catorce puntos (14); el
                            medio punto en el promedio promocional favorece al estudiante.</b></p>
                    </div>
                    <div class="col-sm-3"></div>
                </div> <br>





            <b >13.2. Evaluación del logro de competencias</b>
            <p class="margen">Son aquellos que determinan los niveles de aprendizaje de los estudiantes en las asignaturas. <br><br>
                <b>a) Nivel de inicio:</b> Necesita reforzar las capacidades previstas en coordinación con la Dirección de Escuela y/o
                Estudios Generales, según corresponda. (0-13). <br>
                <b>b) Nivel logrado: </b> Muestra un nivel adecuado de dominio de las capacidades en la asignatura (14-17). <br>
                <b>c) Nivel avanzado: </b> Posee un alto nivel de dominio de las capacidades de la asignatura (18-20). <br><br>
                Los estudiantes que alcancen el nivel de inicio, pasarán a un examen sustitutorio el cual reemplazará a la nota
                más baja obtenida en las tres Unidades. Se dará en la semana última de la programación.
                </p>

            <b>13.3. Evaluación curricular</b>
            <p class="margen">El cumplimiento del currículo se verificará mediante los mecanismos siguientes:  <br><br>
            1º Se hará uso de los indicadores siguientes: <br>
                a. El rendimiento académico de los alumnos a través de la promoción en las experiencias curriculares. <br>
                b. El desempeño en las prácticas pre-profesionales. <br>
                c. La graduación de Bachilleres. <br>
                d. La expedición de títulos <br> <br>
                
                2º Los criterios de evaluación serán las capacidades de las experiencias curriculares, los objetivos del currículo y el
                perfil académico profesional. <br> <br>
                3º La responsabilidad de la evaluación del currículo corresponde al Director de la Escuela y al Comité Académico
                de Currículo de la Facultad. <br> <br>
                4º La evaluación de las experiencias curriculares, del estudiante, del docente y del currículo será semestralmente a
                través de un Informe. <br> <br>
                5° La evaluación del currículo se hará en concordancia a las directivas correspondientes que imparta la Oficina
                General de Evaluación Académica de la Universidad.</p>

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
    CKEDITOR.replace( 'contenido' );
</script>
@endsection