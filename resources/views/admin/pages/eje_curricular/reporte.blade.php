<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php 
    date_default_timezone_set('America/Lima');
    setlocale(LC_TIME, 'spanish'); ?>

    <style>
        @page {
               margin: 2.0cm 2.0cm 2.0cm 2.0cm;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px !important;
        }
        .margen{
            margin-left: 30px; 
            text-align:justify !important
        }
        .margen2{
            margin-left: 35px; 
            text-align:justify !important
        }
        .margen3{
            margin-left: 60px; 
            text-align:justify !important
        }
    </style>
    
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
        <b>4. EJES CURRICULARES TRANSVERSALES</b> <br>
        <p>Se denominan ejes transversales a los núcleos vertebradores y articuladores que dan soporte y sentido al desarrollo
        de las asignaturas que constituyen la malla y el plan curricular.</p>
        <b>4.1 Responsabilidad social universitaria</b>
        <div class="margin-left:20px !important; text-align:justify !important">  
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
                {!!$eje_curricular->responsabilidad_social!!}
            @endif
        </div>

        <b>4.2 Investigación formativa</b>
        <div class="margin-left:20px !important; text-align:justify !important">  
            @if (is_null($eje_curricular->investigacion_formativa))
            <p style="text-align: justify">Es una estrategia didáctica de enseñanza-aprendizaje por la cual 
                los estudiantes en las asignaturas irán desarrollando sus competencias y capacidades investigativas
                 de modo permanente, teniendo como propósito el fortalecimiento de la rigurosidad académica universitaria
                 y la actitud científica.
                </p>                         
            @else
                {!!$eje_curricular->investigacion_formativa!!}
            @endif
        </div>

        <b>4.3 I+D+i (investigación + desarrollo + innovación)</b>
        <div class="margin-left:20px !important; text-align:justify !important">  
            @if (is_null($eje_curricular->idi))
            <p style="text-align: justify">La investigación científica es el proceso necesario para crear conocimiento científico; 
                la innovación, el uso de ese conocimiento para, a través de la tecnología, generar bienestar en la sociedad. Su 
                adecuada y oportuna articulación generan desarrollo. Es, entonces, este eje curricular fundamental para impulsar 
                planes de desarrollo sostenible de la región y del país, así como del contexto internacional; por eso está muy ligado 
                con el modelo de responsabilidad social de la UNT.                                
                </p>                          
            @else
                {!!$eje_curricular->idi!!}
            @endif
        </div>

        <b>4.4 Sostenibilidad ambiental</b>
        <div class="margin-left:20px !important; text-align:justify !important">  
            @if (is_null($eje_curricular->sostenibilidad_ambiental))
            <p style="text-align: justify">Este eje permitirá desarrollar la conciencia y responsabilidad ambiental
                en vista a los graves problemas que aquejan al planeta. Por ende, el currículo debe considerar 
                actividades, proyectos y estrategias didácticas que permitan el cuidado, la prevención y el tratamiento
                 de los problemas ambientales locales, regionales y nacionales con alternativas de solución.                             
               </p>                       
            @else
                {!!$eje_curricular->sostenibilidad_ambiental!!}
            @endif
        </div>

        <b>4.5 Ética y ciudadanía</b>
        <div class="margin-left:20px !important; text-align:justify !important">  
            @if (is_null($eje_curricular->etica))
            <p style="text-align: justify">Con este eje se propone el diseño de actividades y experiencias académicas, que 
                le permitirán al futuro profesional, tener competencias y virtudes morales personales para el bien común
                 y que desde su profesión contribuyan responsablemente en la construcción de una sociedad libre, democrática, 
                 justa, pacífica y feliz.                            
                </p>                         
            @else
               {!!$eje_curricular->etica!!}
            @endif
        </div>

        <b>4.6 Identidad, interculturalidad e inclusividad</b>
        <div class="margin-left:20px !important; text-align:justify !important">  
            @if (is_null($eje_curricular->identidad))
            <p style="text-align: justify">La interrelación de los aprendizajes de los estudiantes con la realidad local y global, 
                a partir de un análisis crítico, pluralista y tolerante, es importante para forjar su conciencia identitaria 
                e histórica, y así contribuir a la revaloración en la diversidad y a su desarrollo inclusivo e integrador, 
                donde todos los peruanos se vean iguales y con el mismo valor. El énfasis está en orientar, respecto a la 
                formación de los futuros profesionales, dentro de una concepción igualitaria de oportunidades, a la atención 
                que se debe brindar a las poblaciones vulnerables y a las personas con habilidades diferentes.                              
                </p>                         
            @else
                {!!$eje_curricular->identidad!!}
            @endif
        </div>

        <b>4.7 Multidisciplinariedad e interdisciplinariedad</b>
        <div class="margin-left:20px !important; text-align:justify !important">  
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
                {!!$eje_curricular->multidisciplinaria!!}
            @endif
        </div> <br>
<!--
        <p style="text-align: justify">
            Por lo anteriormente manifestado debemos considerar el trabajo en equipo, como parte de un enfoque abierto y
            flexible en el ámbito disciplinar y epistemológico. Todo este proceso se inicia en el pregrado (a través de los
            estudios generales, de cursos electivos o algunos cursos de especialidad de los últimos años, de preferencia), y
            se completa plenamente en el posgrado. Las asignaturas multidisciplinarias serán impartidas por un docente
            coordinador y docentes invitados de diferentes disciplinas sobre la base de un conocimiento común. En cambio,
            las asignaturas interdisciplinarias se realizarán con varios especialistas al mismo tiempo, de disciplinas diferentes
            para abordar didácticamente temáticas complejas siendo normado en un Reglamento especial.

        </p>-->

        </div>

    </div>
</body>
</html>