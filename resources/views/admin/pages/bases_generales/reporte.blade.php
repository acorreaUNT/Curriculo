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
            margin-left: 30px; 
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
</body>
</html>