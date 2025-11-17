<!DOCTYPE html>
<html lang="es">
<head>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
     integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?php 
    date_default_timezone_set('America/Lima');
    setlocale(LC_TIME, 'spanish'); ?>

    <style>
        @page :first{
            margin: 0cm 0cm;
        }
        @page {
            margin: 2.0cm 2.0cm 2.0cm 2.0cm;
        }
        .contenedor{
            position: relative;
            display: inline-block;
            text-align: center;
        }
        .contenedor2{
            position: absolute;
            display: inline-block;
            text-align: center;
        }
        .centrado{
            position: absolute;
            top: 52%;
            left: 50%;
            right: -60%;
            transform: translate(-50%, -50%);
            font-size: 30px;
            color: #1f3864;
            font-weight: bold;
        }
        .texto{
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
        .borde{
            border-bottom: 1px solid white !important
        }

        .borde2{
            border-bottom: 1px solid black !important
        }

        .cuadro{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px !important;
        }
        .centrado2{
            text-align: center;
            font-weight: bold;
            vertical-align:middle !important;
        }
        .gris{
            font-weight: bold;
            background-color: #d9d9d9;
        }
        .G{
            background-color: #5FC341;
        }
        .ESPECIFICO{
            background-color: #F76725 !important;
        }
        .ESPECIALIDAD{
            background-color: #41BCC3;
        }
        .GENERAL{
            background-color: #5FC341;
        }
        .EXTRACURRICULAR{
            background-color: #5FC341;
        }
        .centrar{
            text-align: center;
            vertical-align:middle !important;
        }
        .sin_margen{
            margin:0 !important; 
            padding:0 !important; 
        }
        .borde3{
            border: 1px solid black;
        }
        .verticalText {
            writing-mode: vertical-rl;
            transform: rotate(270deg);
           
        }
        .table4 {
            table-layout: fixed;
            text-align:center;
            margin-left: auto;
            margin-right: auto;
            empty-cells: show;
        }
    </style>
    
   <style>
       #footer {
  position: fixed;
  bottom: 0px;
  left: 0px;
  right: 0px;
  height: 0px;
  text-align: right;
  background-color: rgb(175, 160, 214);
  border-top: 2px solid gray;
}
.pagenum:before {
  content: counter(page);
}
 
   </style>
    
</head>
<body>

    <div class="contenedor">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('./fondo-caratula.png'))) }}" width="100%">
        <div class="centrado">
            <p style="color: #1f3864; font-weight: bolder !important">FACULTAD</p>
            <p style="color: #1f3864;margin-top: -30px !important">{{mb_strtoupper($caratula->facultad,'utf-8')}}</p> <br> <br>
            <p style="color: #1f3864;">CURRÍCULO DEL PROGRAMA DE ESTUDIOS</p>
            <p style="color:#c00000 !important;font-weight: bolder !important">{{mb_strtoupper($caratula->programa->nombre_programa,'utf-8')}}</p>
            <p style="color:#c00000 !important; margin-top: -30px !important; font-weight: bolder !important">Versión 2021</p> <br>
            <p style="color: #1f3864; font-size: 22px !important">Aprobado:</p>
            <p style="color: #1f3864; font-size: 22px !important; margin-top: -20px !important">RCF N° {{$caratula->rcf}}</p>
            <p style="color: #1f3864; font-size: 22px !important; margin-top: -20px !important">RCU N° {{$caratula->rcu}}</p>
        </div>
    </div>


    <div style="page-break-after:always;"></div>
    <div class="row texto">
        <div class="col-sm-12">
    <h1 class="text-center" style="font-size: 16px !important"><b>ÍNDICE</b></h1> <br>
            <table class="" style="width: 100% !important">
                <tbody>                   
                    <tr >
                        <td>PRESENTACIÓN ..........................................................................................................................................................................</td>
                        <td>@if (!is_null($indice->n_presentacion))
                            {{$indice->n_presentacion}}
                        @endif</td>
                    </tr>
                    <tr >
                        <td style="margin-top: 7px !important">INTRODUCCIÓN ..........................................................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">@if (!is_null($indice->n_introduccion))
                            {{$indice->n_introduccion}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td  style="margin-top: 7px !important">BASES GENERALES ...................................................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">@if (!is_null($indice->n_bases_generales))
                            {{$indice->n_bases_generales}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important"> - BASES NORMATIVAS ......................................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">@if (!is_null($indice->n_bases_normativas))
                            {{$indice->n_bases_normativas}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important"> - BASES INSTITUCIONALES  .............................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">@if (!is_null($indice->n_bases_institucionales))
                            {{$indice->n_bases_institucionales}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important"> - BASES TEÓRICO - CONCEPTUALES ............................................................................................................................</td>
                        <td  style="margin-top: 7px !important">@if (!is_null($indice->n_bases_teorica))
                            {{$indice->n_bases_teorica}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">ESTUDIO DE LA DEMANDA SOCIAL Y EL MERCADO LABORAL ............................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_estudio_demanda))
                            {{$indice->n_estudio_demanda}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">OBJETIVOS EDUCACIONALES ...................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_obj_educacionales))
                            {{$indice->n_obj_educacionales}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important" >EJES CURRICULARES TRANSVERSALES .................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_ejes_curriculares))
                            {{$indice->n_ejes_curriculares}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">COMPETENCIAS ...........................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_competencias))
                            {{$indice->n_competencias}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- GENÉRICAS  .......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_genericas))
                            {{$indice->n_genericas}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- ESPECÍFICAS .....................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_especificas))
                            {{$indice->n_especificas}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">PERFILES ......................................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_perfiles))
                            {{$indice->n_perfiles}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- DE INGRESO ......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_perfil_ingreso))
                            {{$indice->n_perfil_ingreso}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- DE EGRESO .......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_perfil_egreso))
                            {{$indice->n_perfil_egreso}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">MAPA CURRICULAR ......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_mapa_curricular))
                            {{$indice->n_mapa_curricular}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">MALLA CURRICULAR ....................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_malla_curricular))
                            {{$indice->n_malla_curricular}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">PLAN DE ESTUDIOS .....................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_plan_estudios))
                            {{$indice->n_plan_estudios}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">SUMILLAS ......................................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_sumilla))
                            {{$indice->n_sumilla}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">ESTRATEGIAS DE ENSEÑANZA APRENDIZAJE EN ENFOQUE POR COMPETENCIAS .........................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_estrategias_ensenanza))
                            {{$indice->n_estrategias_ensenanza}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">LINEAMIENTOS DE GESTIÓN CURRICULAR ..............................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_lineamientos))
                            {{$indice->n_lineamientos}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">SISTEMA DE EVALUACIÓN ..........................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_sistema_evaluacion))
                            {{$indice->n_sistema_evaluacion}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- EVALUACIÓN DE LOS APRENDIZAJES ..........................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_eval_aprendizaje))
                            {{$indice->n_eval_aprendizaje}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- EVALUACIÓN DEL LOGRO DE COMPETENCIAS ............................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_eval_logro))
                            {{$indice->n_eval_logro}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- EVALUACIÓN CURRICULAR ............................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_eval_curricular))
                            {{$indice->n_eval_curricular}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">REFERENCIAS BIBLIOGRÁFICAS ...............................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_referencias))
                            {{$indice->n_referencias}}
                        @endif</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">ANEXOS ........................................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">@if (!is_null($indice->n_anexos))
                            {{$indice->n_anexos}}
                        @endif</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
            <div style="page-break-after:always;"></div>


            <div class="row texto">
        <div class="col-sm-12">
            {!!$presentacion->contenido!!}
        </div>
    </div>

    <div style="page-break-after:always;"></div>
    
    <div class="row texto">
        <div class="col-sm-12">
            {!!$introduccion->contenido!!}
        </div>
    </div>

    <div style="page-break-after:always;"></div>
    <!-- inicio bases generales -->
    <div class="row texto">
        <div class="col-sm-12">
            <b>3.1. BASES DEL CURRÍCULO </b> <br>
            <b>3.1.1 Bases Normativas:</b><br>
               <div>{!!$base_general->bn_contenido!!}</div> 
            <b>3.1.2 Bases de Identidad-Institucional </b> <br>
            <b style="margin-left: 28px">3.1.2.1 Valores de la UNT</b><br>
            <ul style="margin-left: 45px">
                <li>Verdad</li>
                <li>Justicia</li>
                <li>Excelencia</li>
                <li>Respeto</li>
                <li>Libertad</li>
                <li>Solidaridad</li>
                <li>Responsabilidad</li>
                <li>Integridad</li>
            </ul>
            <b style="margin-left: 28px">3.1.2.2 Principios de la UNT</b>
            <p style="margin-left: 67px">La UNT asume los principios establecidos en la ley universitaria
                30220 y, además, enarbola los siguientes principios
                institucionales:</p>
                <ol type="a" style="margin-left: 45px">
                   <li> Búsqueda, cultivo y difusión de la verdad.</li>
                    <li> Ejercicio pleno y racional de la autonomía.</li>
                    <li> Desarrollo de la sensibilidad y el compromiso social.</li>
                    <li> Cultivo del espíritu creativo, crítico, innovador e investigativo.</li>
                    <li> Respeto al interés superior del estudiante.</li>
                    <li> Valoración plena a la vida humana en su diversidad cultural. </li>
                    <li> Práctica y mejoramiento continuo de la calidad académica.</li>
                    <li> Ejercicio de una ética pública, profesional y de respeto al bien común.</li>
                </ol>
            <b style="margin-left: 28px">3.1.2.3 Misión de la UNT</b>
            <p style="margin-left: 67px">Formar profesionales e investigadores de la región norte y el país, con ética y calidad; creadores
            de conocimiento científico, tecnológico, humanístico e innovación, para el desarrollo sostenible de
            la sociedad.</p>
            <b style="margin-left: 28px">3.1.2.4 Visión de la UNT</b>
            <p style="margin-left: 67px">Al 2024, la Universidad Nacional de Trujillo es una de las líderes en excelencia académica y
            producción científica con visibilidad e impacto en Latinoamérica y el mundo.</p>
            @if (is_null($base_general->bi_fac_mision))
                <b style="margin-left: 28px">3.1.2.5 Misión de la Facultad (Opcional)</b>
                <div>{!! $base_general->bi_fac_mision!!}</div>
            @endif
            @if (is_null($base_general->bi_fac_mision))
                <b style="margin-left: 28px">3.1.2.5 Misión de la Facultad (Opcional)</b>
                <div>{!! $base_general->bi_fac_mision!!}</div>
            @endif
            @if (is_null($base_general->bi_fac_vision))
                <b style="margin-left: 28px">3.1.2.6 Visión de la Facultad (Opcional)</b>
                <div>{!! $base_general->bi_fac_vision!!}</div>
            @endif
            @if (is_null($base_general->bi_men_mision))
                <b style="margin-left: 28px">3.1.2.7 Misión del Programa Profesional (OPCIONAL)</b>
                <div>{!! $base_general->bi_men_mision!!}</div>
            @endif
            @if (is_null($base_general->bi_men_vision))
                <b style="margin-left: 28px">3.1.2.8 Visión del Programa Profesional (OPCIONAL)</b>
                <div>{!! $base_general->bi_men_vision!!}</div>
            @endif

            <b>3.1.3 Bases Teórico - Conceptuales</b> <br>
            <b style="margin-left: 28px">3.1.3.1 Concepción del ser humano, sociedad y cultura </b><br>
            <p class="margen">
                @if (is_null($base_general->concepcion_humano))
                    <b style="margin-left: 37px">a) Concepción de hombre</b>
                    <p style="text-align: justify; margin-left: 70px">
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

                    <b  style="margin-left: 70px">b) Concepción de sociedad</b>
                    <p style="text-align: justify;margin-left: 70px">
                        La sociedad es la congregación histórica y cultural de seres humanos en base al desarrollo de una
                        serie de relaciones e interacciones en un determinado tiempo y dentro de un espacio geográfico o
                        entorno natural. La manera en que los hombres se organizan y se relacionan, compatibilizando
                        coincidencias y contradicciones, al interno y externo de las unidades, organizaciones e
                        instituciones, que activan la dinámica social. Y hay sociedad, si hay historia e intereses comunes
                        y una visión de futuro compartido.
                        </p>

                    <b  style="margin-left: 70px">c) Concepción de cultura</b>
                    <p style="text-align: justify; margin-left: 70px">
                        La cultura es el conjunto múltiple de productos y valores tanto materiales (instrumentos, artefactos,
                        edificaciones, etc.) como ideales o espirituales (ciencia, filosofía, estética, religión, axiología,
                        política, leyes, tradiciones, etc.) que han sido elaborados socio históricamente, difundidos y
                        preservados, fundamentalmente, gracias a la educación.
                            </p>
                @else
                    <div class="margen">
                        {!!$base_general->concepcion_humano!!}<br></div>
                @endif
            </p>

            <b style="margin-left: 28px">3.1.3.2 Concepción epistemológica </b><br>
            <p class="margen">
                @if (is_null($base_general->concepcion_episte))
                    <b style="margin-left: 37px">a) El conocimiento científico</b>
                    <p style="text-align: justify; margin-left: 70px" class="margen">
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
                    <div class="margen">
                        {!!$base_general->concepcion_episte!!}<br></div>
                @endif  
            </p>

            <b style="margin-left: 28px">3.1.3.3 Concepción curricular </b><br>
            <p class="margen">
                @if (is_null($base_general->concepcion_curricular))
                    <p style="text-align: justify; margin-left: 70px" class="margen">
                        El currículo es un instrumento teórico y operativo, en el cual se plasma una concepción filosófica
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
                <div class="margen">
                    {!!$base_general->concepcion_curricular!!}<br></div>
                @endif
            </p>
           
        </div>

    </div>
    <!--fin bases generales-->
    <br><br> 
    <!--Inicio estudio demanda-->
    <div class="row texto">
            <div class="col-sm-12">
            <b>2. ESTUDIO DE LA DEMANDA SOCIAL Y EL MERCADO LABORAL</b> <br>
            <b>2.1. Determinación y justificación del ámbito de influencia del programa.</b>
            <div class="margin-left:20px !important; text-align:justify !important">{!!$estudio_demanda->influencia_programa!!}</div>

            <b>2.2. Resultados de la demanda laboral profesional</b>
            <div class="margin-left:30px !important; text-align:justify !important">{!!$estudio_demanda->laboral_profesional!!}</div>

            <b>2.3. Resultados de la demanda formativa y oferta formativa similar existente 
                en el ámbito de influencia y su impacto en el ámbito laboral de los egresados del programa:</b>
            <div class="margin-left:30px !important; text-align:justify !important">{!!$estudio_demanda->demanda_formativa!!}</div>

            <b>2.4.	Justificación de la pertinencia social, cultural o académica de la propuesta 
                (o pertinencia con las políticas nacionales, internacionales o regionales):</b>
            <div class="margin-left:30px !important; text-align:justify !important">{!!$estudio_demanda->pertinencia_social!!}</div>

            <b>2.5.	Características y justificación de las modalidades de estudio:</b>
            <div class="margin-left:30px !important; text-align:justify !important">{!!$estudio_demanda->modalidades_estudio!!}</div>
        </div>
    </div>
    <!--fin estudio de demanda-->
    <br><br>
    <!--Objetivos Educacionales-->
    <div class="row texto">
        <div class="col-sm-12">
            <b> 3. OBJETIVOS EDUCACIONALES </b>
            {!!$objetivo->contenido!!}
        </div>
    </div>
    <!--fin objetivos educacionales-->
    <br><br>

    <!--Ejes curriculares transversales-->
    <div class="row texto">
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
    <!--fin de ejes curriculares transversales-->
    <br> <br>
    
    <!--inicio de competencias y capacidades-->
    <div class="row texto">
        <div class="col-sm-12">
            <b>5. COMPETENCIAS</b><br>
            <b>5.1. Competencias genéricas - EGUNT</b><br>
            
            <table class="table cuadro" border="1" >
                    <tr>
                        <td>COMPETENCIAS GENÉRICAS</td>
                        <td>CAPACIDADES</td>
                    </tr>
                <tbody>
                    @foreach ($competenciasGeneral as $item)
                        <?php $capacidades = \App\Models\Capacidades::where('id_competencia', $item->id)->get(); ?>
                        <?php $total_capacidades = count($capacidades); ?>
                        <?php $c = 0; ?>
                        @foreach ($capacidades as $row)
                            <tr>
                                
                                    <td style="vertical-align : middle;text-align:center;" class="@if($c>=0) borde @endif @if($c==$total_capacidades-1) borde2 @endif">
                                        <p style="text-align: justify !important">@if($c==0){{$item->contenido}}@endif</p></td>    
                               
                                <td><p style="text-align: justify !important">{{$row->contenido}}</p></td>
                            </tr>
                            <?php $c++ ?>
                        @endforeach
                    @endforeach
                    
                </tbody>
            </table> <br>

            <b>5.1. Competencias específica</b><br>
            
            <table class="table cuadro" border="1" >
                    <tr>
                        <td>COMPETENCIAS ESPECÍFICAS</td>
                        <td>CAPACIDADES</td>
                    </tr>
                <tbody>
                    @foreach ($competenciasEspecifico as $item2)
                        <?php $capacidades = \App\Models\Capacidades::where('id_competencia', $item2->id)->get(); ?>
                        <?php $total_capacidades = count($capacidades); ?>
                        <?php $c = 0; ?>
                        @foreach ($capacidades as $row2)
                            <tr>
                      
                                    <td  style="vertical-align : middle;text-align:center;" class="@if($c>=0 && $c<$total_capacidades) borde @endif @if($c==$total_capacidades-1) borde2 @endif">
                                        <p style="text-align: justify !important">@if($c==0){{$item2->contenido}}@endif</p></td>    
                         
                                <td><p style="text-align: justify !important">{{$row2->contenido}}</p></td>
                            </tr>
                            <?php $c++ ?>
                        @endforeach
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
    <!-- fin de competencias y capacidades-->

    <!-- inicio de perfiles-->
    <div class="row texto">
        <div class="col-sm-12">
            <b>6. PERFILES</b><br>
            <b>6.1. De Ingreso</b>
            {!!$perfil->ingreso!!}
            <b>6.2. De Egreso</b>
            {!!$perfil->egreso!!}
        </div>
    </div>
    <!-- fin de perfiles-->
    <div style="page-break-after:always;"></div>
    <!-- INICIO MAPA CURRICULAR -->
    <div class="row texto">
        <div class="col-sm-12">
            <b>7. MAPA CURRICULAR</b> <br> <br>
             <b>7.1. COMPETENCIAS GENERALES</b> <br> <br>
             <table class="table table-bordered table4 table-striped" cellspacing="0"  style="font-size: 7px !important;width:100%;border-collapse:collapse;">
                     <tr class="GridViewScrollHeader" style="background-color: #FFCB88 !important">
                         <td></td>
                         <td></td>
                         @foreach ($competenciasG as $item)
                             <?php $celda = count(\App\Models\Capacidades::where('id_competencia', $item->id)->get()) ?>
                             <td colspan="{{$celda}}">{{$item->contenido}}</td>
                         @endforeach
                     </tr>
                     <tr class="GridViewScrollHeader" style="background-color: #FFCB88 !important"> 
                         <td class="">COD. ASIGN</td>
                         <td class="">Nombre de la asignatura</td>
                         @foreach ($competenciasG as $row)
                             <?php $capacidadesG = \App\Models\Capacidades::where('id_competencia', $row->id)->get() ?>
                             @foreach ($capacidadesG as $aux)
                                 <td class="">{{$aux->contenido}}</td>
                             @endforeach
                         @endforeach
                     </tr>
                     <tbody>
                         @foreach ($cursos as $value => $aux2)
                             <tr  class="GridViewScrollItem">
                                 <td>{{$value = $value + 1}}</td>
                                 <?php $c= 0; $continuacion = stristr($aux2->nombre, 'ACTIVIDAD EXTRACURRICULAR'); ?>
                                 @if ($c>=1 && $continuacion)
                                     
                                 @endif
                                 <td class="{{$aux2->eliminar_tildes(utf8_decode($aux2->tipo))}}">{{$aux2->nombre}}</td>
                                 @foreach ($tcapacidadesG as $aux3)
                                     <?php $verificar = count(\App\Models\MapaCurricular::where('id_capacidad', $aux3->id)
                                                         ->where('id_curso_plan_estudios', $aux2->id)->get()); ?>
                                     @if ($verificar==1)
                                         <td>X</td>
                                     @else
                                         <td></td>
                                     @endif
                                     
                                 @endforeach
                                 @if ($continuacion)
                                     <?php $c++ ?>
                                 @endif
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 <br> <br> <br>
                 <b>7.2. COMPETENCIAS ESPECÍFICAS</b> <br> <br>
                 <table class="table table-bordered table-striped" cellspacing="0"  style="font-size: 7px !important;width:100%;border-collapse:collapse;">
                     <tr class="GridViewScrollHeader" style="background-color: #FFCB88 !important">
                         <td></td>
                         <td></td>
                         @foreach ($competenciasE as $item)
                             <?php $celda = count(\App\Models\Capacidades::where('id_competencia', $item->id)->get()) ?>
                             <td colspan="{{$celda}}">{{$item->contenido}}</td>
                         @endforeach
                     </tr>
                     <tr class="GridViewScrollHeader" style="background-color: #FFCB88 !important"> 
                         <td class="">COD. ASIGN</td>
                         <td class="">Nombre de la asignatura</td>
                         @foreach ($competenciasE as $row)
                             <?php $capacidadesG = \App\Models\Capacidades::where('id_competencia', $row->id)->get() ?>
                             @foreach ($capacidadesG as $aux)
                                 <td class="">{{$aux->contenido}}</td>
                             @endforeach
                         @endforeach
                     </tr>
                     <tbody>
                         @foreach ($cursos as $value => $aux2)
                             <tr  class="GridViewScrollItem">
                                 <td>{{$value = $value + 1}}</td>
                                 <?php $c= 0; $continuacion = stristr($aux2->nombre, 'ACTIVIDAD EXTRACURRICULAR'); ?>
                                 @if ($c>=1 && $continuacion)
                                     
                                 @endif
                                 <td class="{{$aux2->eliminar_tildes(utf8_decode($aux2->tipo))}}">{{$aux2->nombre}}</td>
                                 @foreach ($tcapacidadesE as $aux3)
                                     <?php $verificar = count(\App\Models\MapaCurricular::where('id_capacidad', $aux3->id)
                                                         ->where('id_curso_plan_estudios', $aux2->id)->get()); ?>
                                     @if ($verificar==1)
                                         <td>X</td>
                                     @else
                                         <td></td>
                                     @endif
                                     
                                 @endforeach
                                 @if ($continuacion)
                                     <?php $c++ ?>
                                 @endif
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
        </div>
    </div>
    <!-- FIN MAPA CURRICULAR-->

    <!-- INICIO MALLA CURRICULAR -->
    <div style="page-break-after:always;"></div>
    <div class="row texto">
        <div class="col-sm-12">
            <b>8. MALLA CURRICULAR</b> <br> <br>
            <div class="contenedor2" style="margin: 0cm 0cm 0cm 0cm !important">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('mallas/'.$malla->malla))) }}" width="90%">
            </div>
        </div>
    </div>
    <div style="page-break-after:always;"></div>

    <!-- FIN MALLA CURRICULAR-->
    <br><br>
    <!-- INICIO PLAN DE ESTUDIOS -->
    <div class="row texto">
        <div class="col-sm-12">
            <b>9. PLAN DE ESTUDIOS </b> <br><br>
            <table class="table" border="1" style="font-size: 9px !important; width: 100% !important">
                    <tr>
                        <td rowspan="2" class="centrado2">CICLO</td>
                        <td rowspan="2" class="centrado2">CÓDIGO</td>
                        <td rowspan="2" class="centrado2">ASIGNATURA</td>
                        <td rowspan="2" class="centrado2" style="width:4% !important">TIPO(G,E,S)</td>
                        <td colspan="3" class="centrado2">HORAS SEMANALES</td>
                        <td rowspan="2" style="width:1% !important" class="centrado2">CRÉDITOS</td>
                        <td rowspan="2" class="centrado2">REQUISITOS</td>
                        <td rowspan="2" class="centrado2">DPTO. QUE ATIENDE</td>
                    </tr>
                    <tr>
                        <td class="centrado2" style="width:3% !important">Teoría</td>
                        <td class="centrado2" style="width:3% !important"> Práctica</td>
                        <td class="centrado2" style="width:3% !important">Total</td>
                    </tr>
                <tbody>
                    @for ($i = 0; $i < $plan_estudio->programa->num_ciclos; $i++)
                        <?php $total_ht = 0; $total_hp = 0; $total_creditos = 0; ?>
                        <?php $cursos = App\Models\CursosPlanEstudios::where('ciclo', $plan_estudio->a_romano($i + 1) )
                          ->where('id_plan_estudio', $plan_estudio->id)->get();  ?>
                        <?php $totales_curso = count($cursos2) ?>
                        <?php
                            foreach ($cursos as $value) {
                              $total_ht = $total_ht + $value->ht;
                              $total_hp = $total_hp + $value->hp;
                              $total_creditos = $total_creditos + $value->creditos;
                            }
                        ?>
                        @foreach ($cursos as $item)
                            @if ($item->ciclo == $plan_estudio->a_romano($i + 1))
                                <tr class="{{$item->eliminar_tildes(utf8_decode($item->tipo))}}">
                                    <td class="centrar">{{$item->ciclo}}</td>
                                    <td></td>
                                    <td class="centrar">{{$item->nombre}}</td>
                                    <td class="centrar">
                                        @if ($item->tipo == 'GENERAL')
                                            <?php echo 'G' ?>
                                        @endif
                                        @if ($item->tipo == 'EXTRACURRICULAR')
                                            <?php echo 'G' ?>
                                        @endif
                                        @if ($item->tipo == 'ESPECÍFICO')
                                            <?php echo 'E' ?>
                                        @endif
                                        @if ($item->tipo == 'ESPECIALIDAD')
                                            <?php echo 'S' ?>
                                        @endif
                                    </td>
                                    <td class="centrar">{{$item->ht}}</td>
                                    <td class="centrar">{{$item->hp}}</td>
                                    <td class="centrar">{{$item->h_semana}}</td>
                                    <td class="centrar">{{$item->creditos}}</td>
                                    <td>
                                        <?php $requisitos = \App\Models\CursoRequisito::where('id_curso', $item->id)->get() ?>
                                            <ul class="sin_margen">
                                                @foreach ($requisitos as $row)
                                                    <li>{{$row->requisito->nombre}}</li>
                                                @endforeach
                                            </ul>
                                    </td>
                                    <td>
                                        <?php $departamentos =  \App\Models\CursoDepartamento::where('id_curso', $item->id)->get() ?>
                                            <ul class="sin_margen">
                                                @foreach ($departamentos as $item2)
                                                    <li>{{$item2->departamento->nombre_departamento}}</li>
                                                @endforeach
                                            </ul>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                       
                        <tr class="centrado2">
                            <td colspan="2"></td>
                            <td>TOTALES</td>
                            <td>{{$total_ht}}</td>
                            <td>{{$total_hp}}</td>
                            <td>{{$total_ht + $total_hp }}</td>
                            <td>{{$total_creditos}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    @endfor
                </tbody>
            </table>
        <br>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="justify-content: center !important; margin-left: 50px !important">
                  
                  <?php $curso_generales = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'GENERAL')->get();?>
                  <?php $curso_ext = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'EXTRACURRICULAR')->get();?>
                  <?php $curso_esp = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECÍFICO')->get();?>
                  <?php $curso_espec = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECIALIDAD')->get();?>
                  <?php $t_curso_generales = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'GENERAL')->get());?>
                  <?php $t_curso_ext = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'EXTRACURRICULAR')->get());?>
                  <?php $t_curso_esp = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECÍFICO')->get());?>
                  <?php $t_curso_espec = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECIALIDAD')->get());?>
                  <?php $total_asignaturas = $t_curso_generales + $t_curso_ext + $t_curso_esp + $t_curso_espec; ?>
                  <?php $total_horas = $curso_generales->sum('h_semana') + $curso_ext->sum('h_semana') + $curso_esp->sum('h_semana') + $curso_espec->sum('h_semana'); ?>
                  <?php $total_creditos = $curso_generales->sum('creditos') + $curso_esp->sum('creditos') + $curso_espec->sum('creditos'); ?>
                 
                  <table class="table centrar">
                    
                      <tr style="background-color: #ECE4D9">
                        <td>TIPO DE ESTUDIOS</td>
                        <td>N° ASIGNATURAS</td>
                        <td>N° HORAS</td>
                        <td>%</td>
                        <td>N° CRÉDITOS</td>
                        <td>%</td>
                      </tr>
                
                    <tbody>
                      <tr style="background-color: #5FC341; ">
                        <td>ESTUDIOS GENERALES (G)</td>
                        <td>{{$t_curso_generales + $t_curso_ext}}</td>
                        <td>{{$curso_generales->sum('h_semana') + $curso_ext->sum('h_semana') }}</td>
                        <td>@if (($curso_generales->sum('h_semana') + $curso_ext->sum('h_semana'))>0)
                          {{ $porcT1 = round(((($curso_generales->sum('h_semana') + $curso_ext->sum('h_semana'))/$total_horas) * 100),2) }}
                          @else
                          {{$porcT1 = 0}}
                        @endif</td>
                        <td>{{$curso_generales->sum('creditos')}}</td>
                        <td>@if ($curso_generales->sum('creditos')>0)
                          {{$porcC1 = round(((($curso_generales->sum('creditos'))/$total_creditos) * 100),2) }}
                        @else
                        {{$porcC1 = 0 }}
                        @endif
                          
                        </td>
                      </tr>
                      <tr style="background-color: #F76725;">
                        <td>ESTUDIOS ESPECÍFICOS (E)</td>
                        <td>{{$t_curso_esp}}</td>
                        <td>{{$curso_esp->sum('h_semana')}}</td>
                        <td>@if ($curso_esp->sum('h_semana')>0)
                          {{$porcT2 = round(((($curso_esp->sum('h_semana'))/$total_horas) * 100),2) }}
                        @else
                        {{$porcT2 = 0 }}
                        @endif
                          
                        </td>
                        <td>{{$curso_esp->sum('creditos')}}</td>
                        <td>@if ($curso_esp->sum('creditos')>0)
                          {{$porcC2 = round(((($curso_esp->sum('creditos'))/$total_creditos) * 100),2) }}
                        @else
                        {{$porcC2 = 0 }}
                        @endif
                          
                        </td>
                      </tr>
                      <tr style="background-color: #41BCC3;">
                        <td>ESTUDIOS DE ESPECIALIDAD (S)</td>
                        <td>{{$t_curso_espec}}</td>
                        <td>{{$curso_espec->sum('h_semana')}}</td>
                        <td>@if ($curso_espec->sum('h_semana')>0)
                          {{$porcT3 = round(((($curso_espec->sum('h_semana'))/$total_horas) * 100),2)}}
                        @else
                        {{$porcT3 = 0}}
                        @endif
                          
                        </td>
                        <td>{{$curso_espec->sum('creditos')}}</td>
                        <td>@if ($curso_espec->sum('creditos')>0)
                          {{$porcC3 = round(((($curso_espec->sum('creditos'))/$total_creditos) * 100),2) }}
                        @else
                        {{$porcC3 = 0 }}
                        @endif
                         
                        </td>
                      </tr>
                      <tr style="background-color: #ECE4D9">
                        <td><b>TOTAL</b></td>
                        <td>{{$total_asignaturas}}</td>
                        <td>{{$total_horas}}</td>
                        <td>{{$porcT1 + $porcT2 + $porcT3}}</td>
                        <td>{{$total_creditos}}</td>
                        <td>{{$porcC1 + $porcC2 + $porcC3}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-sm-2"></div>
              </div>
            
            </div>
    </div>
    <!-- FIN PLAN DE ESTUDIOS-->
    <br><br>
   <!-- <div style="page-break-after:always;"></div>-->

    <!-- Inicio de sumillas  -->
    <div class="row texto">
        <div class="col-sm-12">
            <b>10. SUMILLAS </b><br><br>
            @foreach ($sumillas as $item)
            <table class="table borde3">
                <tr class="text-center borde3 {{$item->eliminar_tildes(utf8_decode($item->curso->tipo))}}" >
                    <td colspan="11" class="borde3"><b>ASIGNATURA: {{mb_strtoupper($item->curso->nombre,'utf-8')}}</b> </td>
                </tr>
                <tr>
                   <td class="gris borde3">Ciclo </td>
                   <td class="borde3">{{$item->curso->ciclo}}</td>
                   <td class="gris borde3">Código: </td>
                   <td class="borde3">{{$item->curso->codigo}}</td>
                   <td class="gris borde3">Naturaleza: </td>
                   <td class="borde3">{{$item->curso->naturaleza}}</td>
                   <td class="gris borde3">Requisito:</td>
                   <td class="borde3" colspan="3">
                       <?php $requisitos = \App\Models\CursoRequisito::where('id_curso', $item->curso->id)->get() ?>
                       @if (count($requisitos)>=2)
                           <ul>
                               @foreach ($requisitos as $row)
                                   <li>{{$row->requisito->nombre}}</li>
                               @endforeach
                           </ul>
                       @else
                           @foreach ($requisitos as $row)
                               {{$row->requisito->nombre}}
                           @endforeach
                       @endif
                   </td>
                   <td class="gris borde3">Código de la Capacidad: </td>
                </tr>
                <tr>
                    <td class="gris borde3">Total horas</td>
                    <td class="borde3">{{$item->curso->total_h}}</td>
                    <td class="gris borde3">Horas por semana</td>
                    <td class="borde3">{{$item->curso->h_semana}}</td>
                    <td class="gris borde3">Créditos</td>
                    <td class="borde3">{{$item->curso->creditos}}</td>
                    <td class="gris borde3">HT</td>
                    <td class="borde3">{{$item->curso->ht}}</td>
                    <td class="gris borde3">HP</td>
                    <td class="borde3">{{$item->curso->hp}}</td>
                    <td class="borde3">{{$item->curso->codigo_capacitaciones}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="gris borde3">Sumilla</td>
                    <td colspan="9" class="borde3">
                        {{$item->contenido_sumillas}}
                    </td>
                </tr>
                <tr>
                   <td colspan="2" class="gris borde3">Ejes Transversales</td>
                   <td colspan="9" class="borde3">
                        {{$item->ejes_transversales}}
                   </td>
               </tr>
               <tr>
                   <td colspan="2" class="gris borde3">Departamento(s)
                       Académico(s)
                       Responsable (s)</td>
                   <td colspan="3" class="borde3">
                    <?php $departamentos = \App\Models\CursoDepartamento::where('id_curso', $item->curso->id)->get() ?>
                       @if (count($departamentos)>=2)
                           <ul>
                               @foreach ($departamentos as $item2)
                                   <li>{{$item2->departamento->nombre_departamento}}</li>
                               @endforeach
                           </ul>
                       @else
                           @foreach ($departamentos as $item2)
                               {{$item2->departamento->nombre_departamento}}
                           @endforeach
                       @endif
                   </td>
                   <td colspan="2" class="gris borde3">Perfil específico
                       del docente /
                       equipo formador</td>
                   <td colspan="4" class="borde3">
                     {{$item->perfil_docente}}
                   </td>
               </tr>
             </table>
                <div style="page-break-before: always;"></div>
            @endforeach
        </div>
    </div>
    <!-- Fin de sumillas -->

    <!--Inicio de estrategias de enseñanaza-->
    <div class="row texto">
        <div class="col-sm-12">
            <b> 11. ESTRATEGIAS DE ENSEÑANZA APRENDIZAJE EN ENFOQUE POR COMPETENCIAS </b>
            {!!$estrategia->contenido!!}
        </div>
    </div>
    <!--Fin de estrategias de enseñanaza-->
    <br><br>

    <!-- inicio lineamientos de gestion curricular -->
    <div class="row texto">
        <div class="col-sm-12">
        <b>12. LINEAMIENTOS DE GESTIÓN CURRICULAR</b>
            <p class="margen">El diseño o actualización curricular de los estudios de pregrado, posgrado y segundas especialidades de la UNT se regirán
            por los siguientes lineamientos:</p> <br>
            
            <b>12.1. Sobre el diseño curricular</b>
            <p class="margen">El Modelo Educativo reformado de la Universidad Nacional de Trujillo (MOEDUNT) es la base para el diseño y la
            gestión curricular de los programas de estudios de pregrado, posgrado y segundas especialidades. </p>

            <b>12.2. Sobre el enfoque curricular</b>
            <p class="margen">El MOEDUNT asume integradamente el enfoque curricular por competencias y el diseño curricular integral,
                humanístico, flexible, histórico-crítico, sociocultural, intercultural, inclusivo y contextualizado.</p>

            <b>12.3. Sobre la operativización de las competencias educativas</b>
            <p class="margen">El diseño curricular operará con las siguientes categorías: COMPETENCIAS - CAPACIDADES - RESULTADOS DE
                APRENDIZAJE. </p>

            <b>12.4. Sobre la estructura del diseño curricular</b>
            <p class="margen">Los diseños curriculares de los Programas de estudios de pregrado, posgrado y segundas especialidades de la UNT,
                deberán estructurarse según la naturaleza de la carrera profesional.</p>

            <b>12.5. Sobre las competencias y las áreas del currículo</b>
            <p class="margen">Los programas de estudios de pregrado, posgrado y segundas especialidades desarrollan articuladamente dos
                grandes bloques de competencias: a) genéricas y b) específicas.<br>
                En los programas de estudios de pregrado, las competencias se desarrollan en tres áreas de estudio:<br>
                a) Estudios Generales, b) Estudios Específicos y c) Estudios de Especialidad.<br>
                En Posgrado y segundas especialidades solo se tendrá dos áreas:<br>
                a) Estudios Específicos y b) Estudios de Especialidad. </p>
            
            <b>12.6. Sobre el régimen de estudio </b>
            <p class="margen">El régimen de estudios y la organización curricular para todos los programas profesionales de pregrado, posgrado o
                segundas especialidades es semestral y de dieciséis semanas cada uno. Solo pueden desarrollarse dos semestres
                por año académico. <br>
                En los estudios de pregrado, en el primer semestre del año académico se desarrollan los ciclos impares de estudios;
                en el segundo, los ciclos pares. En cada ciclo de estudio se programan y desarrollan máximo hasta seis (06)
                asignaturas o módulos. En los últimos ciclos de estudios se enfatiza en el trabajo de la investigación científica
                orientados a los procesos de graduación y titulación, así como a las prácticas pre profesionales. <br>
                Los estudios universitarios pueden desarrollarse bajo las modalidades presencial, semipresencial y a distancia o no
                presencial, con el objeto de "ampliar el acceso a la educación de calidad y adecuar la oferta universitaria a las diversas
                necesidades educativas", pero bajo las disposiciones legales que los regulan.</p>

            <b>12.7. Sobre los créditos académicos </b>
            <p class="margen">Los programas de estudios de pregrado son de cinco años y diez ciclos académicos, de 22 créditos cada uno, con un
                total de 220 créditos académicos. Los programas de estudio de seis y siete años de estudios (caso de Derecho,
                Estomatología, Medicina y Farmacia) incrementarán proporcionalmente su creditaje. Los programas de estudios de
                pregrado integran los Estudios Generales, los Estudios Específicos y los Estudios de Especialidad; el creditaje total
                se distribuye proporcional y respectivamente así: 16%, 24% y 60%.
                Los programas de estudios de posgrado son semestrales y tienen el siguiente creditaje mínimo: <br>
                1) Diplomados de Posgrado, veinticuatro (24) créditos.<br>
                2) Maestrías, cuarenta y ocho (48) créditos.<br>
                3) Doctorados, sesenta y cuatro (64) créditos.<br>
                Segunda Especialidad Profesional, mínimo de cuarenta (40) créditos. </p>

            <b>12.8. Sobre el creditaje de la educación no presencial </b>
            <p class="margen">La modalidad de educación no presencial puede ser de hasta un 70% del creditaje total de los Programas de estudios
                de pregrado, de posgrado y de segundas especialidades. <br>
                La DDA en coordinación con los directores de escuela supervisará la correcta adecuación de una experiencia
                curricular a la modalidad presencial, semipresencial y no presencial. </p>
            
            <b>12.9. Sobre la organización curricular de los aprendizajes</b>
            <p class="margen">Los currículos de pregrado se pueden organizar por asignaturas o por Módulos de competencia profesional, según
                sea el carácter de los Programas de estudios, todo sustentado según la ley 30220: “Todas las carreras en la etapa
                de pregrado se pueden diseñar, según módulos de competencia profesional, de manera tal que a la conclusión de
                los estudios de dichos módulos permita obtener un certificado, para facilitar la incorporación al mercado laboral. Para
                la obtención de dicho certificado, el estudiante debe elaborar y sustentar un proyecto que demuestre la competencia
                alcanzada” (Artículo 40°).</p>
            
            <b>12.10. Sobre la articulación de los aprendizajes para el logro de competencias</b>
            <p class="margen">La implementación y ejecución de las asignaturas, en cada semestre académico, deben estar orientadas al logro de
                las competencias asegurando la integración de los aprendizajes y sus resultados. Corresponde al Director de
                Escuela velar por su cumplimiento.
                </p>

            <b>12.11. Sobre los Estudios Generales</b>
            <p class="margen">Los Estudios Generales son desarrollados escalonadamente a lo largo de toda la carrera profesional con un mínimo
                de 35 créditos. Son gestionados y administrados por las Escuelas Profesionales bajo la supervisión del
                Vicerrectorado Académico, a través de su Unidad Técnica correspondiente. 
                    </p>

            <b>12.12. Sobre la articulación integral de los Programas de estudio de la UNT </b>
            <p class="margen">Los planes de estudio del sistema de preparación de acceso a la universidad (nuevo CEPUNT), de pregrado,
                estudios técnicos, posgrado, segundas especialidades y de formación continua se articulan sistémicamente, según
                los lineamientos del MOEDUNT, para permitir convalidaciones, doble graduación y titulación, y especialización,
                acorde con la Ley Universitaria.  
                            </p>
            
            <b>12.13. Sobre la organización y metodología para el diseño, evaluación y actualización de los currículos </b>
            <p class="margen">Estos procesos estarán dirigidos por los Directores de Escuelas en coordinación con los Comités técnicos de
                currículos (COTECUS) y los Comités de calidad. La metodología tendrá las siguientes etapas: diagnóstico,
                planificación, implementación, ejecución, control, evaluación y plan de mejora; las cuales serán supervisadas por
                la Dirección de Desarrollo Académico (DDA).                
                                            </p>      
        
            <b>12.14. Sobre la multidisciplinariedad y la interdisciplinariedad  </b>
             <p class="margen">Los programas de estudios en la UNT fomentan la interdisciplinariedad y la multidisciplinariedad a nivel inter e
                intracurricular. En general, la poli docencia, las cátedras integradas, paralelas o compartidas no están permitidas;
                solo funcionan aquellas que tengan justificación técnico- curricular y didáctica, y sean avaladas por la Dirección de
                Desarrollo Académico, según Reglamento especial.                 
            </p> 

            <b>12.15. Sobre la investigación formativa como elemento articulador entre la enseñanza aprendizaje (E-A), la I+d+i
                (investigación – desarrollo - innovación), y la responsabilidad social universitaria (RSU).   </b>
             <p class="margen">En la ejecución de los planes curriculares de los programas de estudios de pregrado se articulan y desarrollan
                transversalmente la investigación científica y la responsabilidad social, efectivizándose prioritaria y directamente
                en los cursos prácticos, en la relación con la sociedad, con las empresas y las instituciones públicas y/o privadas,
                viabilizando los "Objetivos de política académica institucional de la gestión 2020-2025" y los convenios que tiene
                la UNT a nivel local, regional, nacional e internacional                
            </p> 

            <b>12.16. Sobre la práctica preprofesional </b>
             <p class="margen">Las prácticas pre profesionales se diseñan, implementan y ejecutan curricularmente en tres niveles: iniciales,
                intermedias y finales, desde el quinto ciclo de estudios y según las particularidades de cada programa de estudios.                 
            </p> 

            <b>12.17. Sobre el nuevo sistema de admisión a la UNT  </b>
            <p class="margen">Implementación de un nuevo sistema de admisión a la Universidad (nuevo CEPUNT) que valore las competencias
                logradas en la Educación Básica Regular, que consolide las capacidades, aptitudes y actitudes básicas y
                necesarias para los estudios universitarios, y que desarrolle y valore los perfiles de los ingresantes según las áreas
                de formación profesional.                 
           </p> 

           <b>12.18. Sobre el sistema de calificación   </b>
            <p class="margen">El sistema de calificación cuantitativa en todos los programas de estudios es vigesimal (de 0 a 20) y se asume
                como nota mínima aprobatoria al puntaje de catorce (14).                
           </p> 
        
           @if (isset($lineamiento))
                {!!$lineamiento->contenido!!}
            @endif
        </div>

    </div>
    <br><br>
    <!-- fin lineamineamiento de gestion curricular -->

    <!--inicio de sistema de evaluación -->
    <div class="row texto">
        <div class="col-sm-12">
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

                @if (isset($sistema_evaluacion))
                    {!!$sistema_evaluacion->contenido!!}
                @endif
                
        </div>

    </div>
    <div style="page-break-before: always;"></div>
    <!-- fin de sistema de evaluación -->

    <div class="row texto">
        <div class="col-sm-12">
            <b>14. REFERENCIAS BIBLIOGRAFÍCAS</b><br>
            {!!$referencia->contenido!!}
        </div>
    </div>
    <div style="page-break-before: always;"></div>
    <div class="row texto" >
        <div class="col-sm-12">
            <h1 class="text-center">TABLA DE CONVALIDACIONES</h1> <br> <br>
            <table class="table" border="1px">         
                    <tr class="text-center" style="background-color: #FFC93A !important">
                        <td colspan="3">PLAN DE ESTUDIOS DEL CURRÍCULO 2018</td>
                        <td colspan="3">PLAN DE ESTUDIOS DEL CURRÍCULO 2021</td>
                    </tr>
                    <tr class="text-center" style="background-color: #FFEB8A !important">
                        <td>CICLO</td>
                        <td>CRÉDITOS</td>
                        <td>CURSO</td>
                        <td>CURSO</td>
                        <td>CRÉDITOS</td>
                        <td>CICLO</td>
                    </tr>
                    <tbody>
                        <?php $c = 0 ?>
                        @foreach ($detalle as $item)
                            <tr>
                                <td>{{$item->ciclo}}</td>
                                <td>{{$item->credito}}</td>
                                <td>{{$item->nombre_curso}}</td>
                                <td>{{$item->cursos->nombre}}</td>
                                <td>{{$item->cursos->creditos}}</td>
                                <td>{{$item->cursos->ciclo}}</td>
                            </tr>
                        <?php $c++ ?>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>


    <div id="footer">
        <p><span class="pagenum"></span></p>
      </div>
         
</body>
</html>