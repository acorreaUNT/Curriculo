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

        @page {
            margin: 2.0cm 2.0cm 2.0cm 2.0cm;
        }
        .contenedor{
            position: relative;
            display: inline-block;
            text-align: center;
        }
        .contenedor2{
            width:100%;
            height:auto;
            }
            
            .contendor2 img {
            width:100%;
            height:auto;
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
            margin-left: 20px; 
            text-align:justify !important
        }
        .margen2{
            margin-left: 10px; 
            text-align:justify !important
        }
        .margen3{
            margin-left: 30px; 
            text-align:justify !important
        }
        .margen4{
            margin-left: 50px; 
            text-align:justify !important
        }
 
        .centrado2{
            text-align: center;
            font-weight: bold;
            vertical-align:middle !important;
            font-size: 16px;
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
        .separacion{
            margin-top: -10px
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

   


    
    <div class="row texto">
        <div class="col-sm-12">
            <div class="contenedor2" style="margin: -2cm -2cm -2cm -2cm !important">
                <img class="header" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img_plan.png'))) }}" width="100%">
            </div>
            
            <p class="centrado2" style="margin-top: 90px !important">UNIVERSIDAD NACIONAL DE TRUJILLO</p>
            <p class="centrado2">FACULTAD DE {{$plan_trabajo->facultad}}</p>
            <p class="centrado2">PROGRAMA DE ESTUDIOS {{$plan_trabajo->programa->nombre_programa}}</p>
            <br> <br>
            <p class="centrado2">PLAN DE TRABAJO </p>
            <p class="centrado2">REDISEÑO Y ACTUALIZACIÓN CURRICULAR</p>
            <br><br>
            <p class="separacion"><b>I.	PARTE INFORMATIVA </b></p>
            <p  class="separacion margen2"><b>1.1	Denominación del proceso: </b>Formación Profesional – Código: PG-M01.01-DDA/PG-01</p>
                <p  class="separacion margen2" ><b>1.2	Procedimiento: </b>Gestión Curricular</p>
                    <p  class="separacion margen2"><b>1.3    Actividad:</b> Rediseño o actualización curricular</p>
                        <p  class="separacion margen2"><b>1.4.    Equipo responsable: </b>Comité Técnico de Currículo (COTECCU) del Programa de Estudios de       {{$plan_trabajo->programa->nombre_programa}}</p>
        
            <br><br>
            <table class="table text-center" border="1">
                <thead>
                    <tr class="text-center" style="font-weight: bold; background-color: #000066; color: white" >
                        <td>Integrantes</td>
                        <td>Cargo</td>
                        <td>No. de Resolución de COTECCU</td>
                    </tr>
                    <tbody>
                        <?php $c = 0 ?>
                        @foreach ($integrantes as $item)
                        <tr>
                            <td>{{$item->apellido}} {{$item->nombre}}</td>
                            <td>{{$item->cargo}}</td>
                            @if ($c == 0)
                            <td rowspan="{{count($integrantes)}}">{{$plan_trabajo->nro_resolucion}}</td>
                            @endif
                            
                        </tr>
                        <?php $c++ ?>
                        @endforeach
                        
                       
                    </tbody>
                </thead>
            </table> <br><br>
            <p  class="separacion margen2"><b>1.5. Fecha de ejecución: </b>Del 15 de septiembre de 2021 al 04 de marzo de 2022</p>
            <br> <br><br>
            <p class="separacion"><b>II. JUSTIFICACIÓN</b></p>
            <p class="separacion margen2">La Universidad para responder a los retos actuales que le plantea la sociedad, debe innovarse académicamente realizando constantes reformas curriculares con el propósito de adecuarse a los retos que la sociedad le impone, planificando adecuada y oportunamente.  <br><br>
        
                La Dirección de desarrollo académico de la Universidad Nacional de Trujillo, tras un proceso de auditoría curricular realizado en julio del 2020, decidió en coordinación con el Vicerrectorado Académico y la Alta Dirección, iniciar un proceso de Reforma Curricular, en razón a lo diagnosticado y a las nuevas políticas generales de gestión académica. Por tal motivo, este proceso empezó con la actualización del Modelo Educativo y la elaboración del nuevo diseño de los Estudios Generales, los cuales son instrumentos normativos fundamentales para la Reforma curricular. <br> <br>
        
                Tras culminarse estos instrumentos, a fines de abril de 2021, la Alta Dirección dispuso que se iniciase la Reforma curricular en una primera etapa en dos Facultades piloto: Educación y Derecho, con diez (10) Programas de estudio, cuya implementación y ejecución se encuentra en desarrollo en el presente semestre. <br><br>
        
                Por tales razones, es menester empezar a implementar la segunda etapa de la reforma curricular con los 35 Programas de estudio faltantes en pregrado. Es fundamental culminar la reforma curricular porque ello permitirá no solo cumplir con lo dispuesto en la ley universitaria sino actualizar este instrumento de formación profesional con las nuevas políticas generales de gestión académica y a las condiciones tecnológicas derivadas del proceso pandémico. <br>
        
                <div class="margen2">
                    {!!$plan_trabajo->contextualizacion!!}
                </div>
            
                
            </p>
        
            
            <br> <br>
           <!-- <div style="page-break-after:always;"></div>-->
            <p class="separacion"><b>III. CRONOGRAMA DE TAREAS/ACTIVIDADES: </b></p>
            <table class="table text-center" border="1" style="margin-left: -45px">
                <tr style="font-size: 9px !important; background-color: #000066; color: white" >
                    <td rowspan="3" >N°</td>
               
                    <td rowspan="3" >TAREA / ACTIVIDAD ESPECÍFICA</td>
               
                    <td colspan="24" >CRONOGRAMA SEMANAL 2021 - 2022</td>
                </tr>
                <tr style="font-size: 9px !important; background-color: #000066; color: white">
                    
                    <td colspan="2">09/2021</td>
                    <td colspan="4">10/2021</td>
                    <td colspan="4">11/2021</td>
                    <td colspan="4">12/2021</td>
                    <td colspan="4">01/2022</td>
                    <td colspan="4">02/2022</td>
                    <td colspan="2">03/2022</td>
                </tr>
                <tr style="font-size: 8px !important; background-color: #000066; color: white">
        
                    <td>S1</td>
                    <td>S2</td>
                    <td>S1</td>
                    <td>S2</td>
                    <td>S3</td>
                    <td>S4</td>
                    <td>S1</td>
                    <td>S2</td>
                    <td>S3</td>
                    <td>S4</td>
                    <td>S1</td>
                    <td>S2</td>
                    <td>S3</td>
                    <td>S4</td>
                    <td>S1</td>
                    <td>S2</td>
                    <td>S3</td>
                    <td>S4</td>
                    <td>S1</td>
                    <td>S2</td>
                    <td>S3</td>
                    <td>S4</td>
                    <td>S1</td>
                    <td>S2</td>
                </tr>
                <tr style="font-size: 8px !important">
                    <td>1.</td>
                    <td>Actualización y/o conformación COTECCUs por carrera.</td>
                    <td style="background-color: black !important"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="font-size: 8px !important">
                    <td>2.</td>
                    <td>Aprobación de Plan de Trabajo de rediseño curricular por carrera.</td>
                    <td style="background-color: black !important"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tr>
            <tr style="font-size: 8px !important">
                <td>3.</td>
                <td>Inducción al aula virtual y herramienta de automatización de diseño curricular.</td>
                <td ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>4.</td>
                <td>Socialización de EGUNT y políticas de gestión curricular.</td>
                <td ></td>
                <td></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>5.</td>
                <td>Diagnóstico de currículo por carrera.</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>6.</td>
                <td>Elaboración de Bases generales.</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>7.</td>
                <td>Caracterización del estudio de la demanda social y mercado laboral. </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>8.</td>
                <td>Evaluación y rediseño de objetivos educacionales. </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>9.</td>
                <td>Evaluación y rediseño de competencias específicas de la carrera.  </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  style="background-color: black !important"></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>10.</td>
                <td>Evaluación y rediseño de perfil de ingreso y egreso. </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>11.</td>
                <td>Elaboración de mapeo curricular.  </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>12.</td>
                <td>Evaluación y rediseño de Plan Estudios y malla curricular.  </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>13.</td>
                <td>Redefinición de sumillas de cursos específicos y de especialidad.  </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>14.</td>
                <td>Selección de estrategias de enseñanza aprendizaje.  </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>15.</td>
                <td>Lineamientos de gestión curricular. </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>16.</td>
                <td>Elaboración de tablas de equivalencias. </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>17.</td>
                <td>Elaborar las referencias bibliográficas, anexos, presentación, introducción, índice, carátula. </td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>18.</td>
                <td>Socialización con grupos de interés</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>19.</td>
                <td>Evaluación y control de calidad de los diseños curriculares</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>20.</td>
                <td>Elaboración de Informe sobre la reforma curricular en pregrado.</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>21.</td>
                <td>Aprobación por Consejo de Facultad</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td></td>
                <td ></td>
                <td  style="background-color: black !important"></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>22.</td>
                <td>Elevación de los currículos al VAC y Consejo universitario</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td></td>
                <td ></td>
                <td></td>
                <td   style="background-color: black !important"></td>
                <td></td>
            </tr>
            <tr style="font-size: 8px !important">
                <td>23.</td>
                <td>Ratificación por Consejo Universitario</td>
                <td ></td>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  ></td>
                <td ></td>
                <td></td>
                <td ></td>
                <td  ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td></td>
                <td ></td>
                <td></td>
                <td  ></td>
                <td  style="background-color: black !important"></td>
            </tr>
            </table>
            <br> <br>
            <p class="separacion"><b>IV. CUADRO DE OBJETIVOS, ACTIVIDADES, PRODUCTOS Y FECHAS DE ENTREGA: </b></p>
            <table class="table text-center" border="1">
                <thead>
                    <tr style="background-color: #000066; color: white; text-align:center !important">
                        <th>OBJETIVO</th>
                        <th>ACTIVIDADES</th>
                        <th>PRODUCTOS</th>
                        <th>FECHAS DE ENTREGA </th>
                    </tr>
                    <tbody>
                        <tr>
                            <td rowspan="3">4.1.1. Organizar el trabajo curricular del COTECCU.</td>
                            <td>Actualización y/o conformación COTECCUs por carrera.</td>
                            <td rowspan="3">Plan de trabajo de rediseño y actualización curricular.</td>
                            <td rowspan="3">15-17 de septiembre 2021</td>
                        </tr>
                        <tr>
                            <td>Aprobación de Plan de Trabajo de rediseño curricular por carrera.</td>
                        </tr>
                        <tr>
                            <td>Inducción al aula virtual y herramienta de automatización de diseño curricular.</td>
                        </tr>
                        <!-- -->
                        <tr>
                            <td>4.1.2. Socializar la normatividad académico-curricular y los lineamientos de políticas generales académicas.</td>
                            <td>Exposición acerca de la normatividad académico-curricular (Modelo educativo UNT, Versión-2) y de los lineamientos de políticas generales académicas.</td>
                            <td>Toma de conocimiento sobre la implementación de la normatividad académico-curricular y de los lineamientos de políticas generales académicas</td>
                            <td>20-24 de septiembre de 2021</td>
                        </tr>
        
                        <tr>
                            <td>4.1.3.
                                Diagnosticar los currículos 2018 para determinar las mejoras a implementar en los currículos a actualizar.
                                </td>
                            <td>Diagnóstico de currículo por programa de estudios.</td>
                            <td>Informe de diagnóstico por programa de estudios.</td>
                            <td>27 de septiembre al 01 de octubre de 2021</td>
                        </tr>
        
                        <tr>
                            <td>4.1.4. 
                                Elaborar las bases generales.
                                </td>
                            <td>Elaboración de Bases generales.</td>
                            <td>Bases Generales elaboradas.</td>
                            <td>04 al 08 de octubre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.5
                                Elaborar la caracterización de la demanda social y el mercado laboral                                 
                                </td>
                            <td>Caracterización del estudio de la demanda social y mercado laboral.</td>
                            <td>Caracterización de la demanda social y mercado laboral elaborada.</td>
                            <td>11 al 15 de octubre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.6
                                Evaluar y rediseñar los objetivos educacionales                                  
                                </td>
                            <td>Evaluación y rediseño de objetivos educacionales.</td>
                            <td>Objetivos educacionales elaborados.</td>
                            <td>18 al 29 de octubre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.7
                                Evaluar y rediseñar las competencias y perfiles                                   
                                </td>
                            <td>Evaluación y rediseño de competencias y perfiles.</td>
                            <td>Competencias y perfiles  elaborados.</td>
                            <td>01 al 05 de noviembre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.8
                                Elaborar el mapa curricular                                  
                                </td>
                            <td>Elaboración de mapeo curricular. </td>
                            <td>Mapeo curricular elaborado.</td>
                            <td>08 al 19 de noviembre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.9
                                Evaluar  y rediseñar  el plan de estudios y malla curricular                                  
                                </td>
                            <td>Evaluación y rediseño del plan de estudios y malla curricular. </td>
                            <td>Plan de estudios y malla curricular elaborado.</td>
                            <td>22 de noviembre al 03 diciembre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.10
                                Elaborar las sumillas de los cursos específicos y de especialidad.                                  
                                </td>
                            <td>Redefinición de sumillas de cursos específicos y de especialidad. </td>
                            <td>Sumillas redifinidas</td>
                            <td>06 al 10 de diciembre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.11
                                Describir las estrategias de enseñanza aprendizaje.                               
                                </td>
                            <td>Seleccionar y describir las estrategias de enseñanza aprendizaje. Presenciales y semipresenciales.  </td>
                            <td>Estrategias de enseñanza aprendizaje descritas</td>
                            <td>13 al 17 de diciembre de 2021</td>
                        </tr>
                        <tr>
                            <td>4.1.12
                                Contextualizar los lineamientos de gestión curricular.                              
                                </td>
                            <td>Contextualizar los lineamientos de gestión curricular a su programa de estudios.   </td>
                            <td>Lineamientos de gestión curricular contextualizados a su programa de estudios.</td>
                            <td>03 al 07 de enero de 2022</td>
                        </tr>
                        <tr>
                            <td>4.1.13
                                Elaborar la tabla de equivalencias.                              
                                </td>
                            <td>Elaboración de la tabla de equivalencias currículo 2018-2021   </td>
                            <td>01 tabla de equivalencias del Plan de estudios 2018 con la nueva versión de currículo</td>
                            <td>10 al 14 de enero de 2022</td>
                        </tr>
                        <tr>
                            <td>4.1.14
                                Elaborar las referencias bibliográficas, anexos, presentación, introducción, índice, carátula.                         
                                </td>
                            <td>Elaboración de  las referencias bibliográficas, anexos, presentación, introducción, índice, carátula.   </td>
                            <td>01 diseño curricular de cada Programa de estudios de pregrado, con las referencias bibliográficas, anexos, Presentación, Introducción, índice, carátula.</td>
                            <td>17 al 21 de enero de 2022</td>
                        </tr>
        
                        <tr>
                            <td>4.1.15. Validar  los currículos actualizados a través de los grupos de interés.</td>
                            <td>Socialización con grupos de interés</td>
                            <td>Acta de socialización con grupos de interés.</td>
                            <td>24 al 28 de enero de 2022</td>
                        </tr>
                        <tr>
                            <td rowspan="5">4.1.16. Tramitar la aprobación del currículo actualizado en las instancias correspondientes de la UNT.</td>
                            <td>Evaluación y control de calidad de los diseños curriculares</td>
                            <td>Currículo revisado por la  Dirección de Procesos Académicos(DPA)</td>
                            <td>31 de enero al 04 de febrero de 2022</td>
                        </tr>
                        <tr>
                            <td>Elaboración de Informe sobre la reforma curricular en pregrado.
                                </td>
                            <td>01 informe sobre la reforma curricular en pregrado.</td>
                            <td>07 al 11 de febrero de 2022</td>
                        </tr>
                        <tr>
                            <td>Aprobación por Consejo
                                de Facultad
                                </td>
                            <td>Resolución de aprobación por Consejo de Facultad.</td>
                            <td>14 al 19 de febrero de 2022</td>
                        </tr>
                        <tr>
                            <td>Elevación de los currículos al VAC y Consejo universitario</td>
                            <td>Trámite</td>
                            <td>21 al 25 de febrero de 2022</td>
                        </tr>
                        <tr>
                            <td>Ratificación por Consejo Universitario</td>
                            <td>Resolución de aprobación por Consejo Universitario</td>
                            <td>28 de febrero al 04 de marzo 2022</td>
                            
                        </tr>
                    </tbody>
                </thead>
            </table>
            <br> <br>
            <p class="separacion"><b>V.	METODOLOGÍA </b></p>
            <p class="separacion margen4">
                <ul style="text-align: justify">
                    <li>Trabajo colaborativo de los integrantes del COTECCU orientado al análisis de las políticas de gestión curricular determinadas por el MOEDUNT actualizado y contextualización al campo laboral de los profesionales que egresan del Programa de estudios.</li> 
                    <li>Uso de herramienta automatizada de diseño curricular y de metodologías activas en aula virtual para registro de currículo, a través de actividades sincrónicas y asincrónicas, con asistencia de recursos virtuales, dando paso al trabajo autónomo del equipo y de sus colaboradores.</li>
                    <li>Uso de técnicas y herramientas socializadoras que faciliten la construcción y validación de los elementos del currículo.</li>
                    <li>Acompañamiento al proceso de rediseño y actualización curricular, por parte de la comisión responsable.</li> 
        
                </ul>
            </p>
        
            <p class="separacion"><b>VI. RECURSOS </b></p>
            <p class="separacion" style="margin-left: 130px"><b>6.1	HUMANOS</b></p>
            <ul style="margin-left: 130px">
                <li>Integrantes del COTECCU</li>
                <li>Equipo capacitador y de acompañamiento</li>
                <li>Directivos del Programa de estudios </li>
                <li>Egresados</li>
                <li>Comité Consultivo del Programa de Estudios</li>
            </ul> <br><br><br>
            <p class="separacion" style="margin-left: 130px"><b>6.2 BIENES</b></p>
            <ul style="margin-left: 130px">
                <li>PC o laptop de uso personal o de equipo de trabajo</li>
            </ul> <br> <br><br>
            <p class="separacion" style="margin-left: 130px"><b>6.3 SERVICIOS</b></p>
            <ul style="margin-left: 130px">
                <li>Apoyo técnico para aula virtual y plataforma zoom.</li>
                <li>Consultor externo o grupo experto para elaborar estudio de la demanda para cada Facultad piloto.</li>
            </ul>
                 <br> <br>
            <p class="separacion"><b>VII. FINANCIAMIENTO</b></p>
            <p style="margin-left: 130px">Se hará con recursos ordinarios de la Direccción de Procesos Académicos(DPA) y del Vicerrectorado Académico(VAC).</p>
            <br> <br>
            <p class="separacion"><b>VIII. EVALUACIÓN</b></p>
            <p style="margin-left: 130px">Se realizará a través de  rúbricas por cada sesión programada en el aula virtual. </p>
            <br> <br><br><br><br>
        
        
                
           
        </div>
        <?php $cantidad = count($integrantes); $c = 1; ?>
        @foreach ($integrantes as $item)
                    <div class="col-xs-4 text-center" style="margin-left: -20px !important"> 
                        <img  src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('./firmas/'.$item->firma))) }}" alt="firma" width="150px" style="height: 80px !important"><br>
                        <div style="margin-top: -20px !important">
                            ______________________________ <br>
                        {{$item->apellido}} {{$item->nombre}}<br>
                        {{$item->cargo}}
                        </div>
                      
                    </div>
                    @if ($c%3 == 0)
                        <h1 style="color: white">.....</h1><br>
                     @endif
                    <?php $c++ ?>
        @endforeach <br> <br>

        
        
    </div> <br> <br>
    <div class="row texto mt-5">
        <div class="col-sm-12 mt-3">
            <p class="separacion"><b>IX. ANEXOS</b></p>
            <p style="margin-left: 130px"><b>9.1.</b> Resolución de constitución de COTECCU </p>
            <p style="margin-left: 130px"><b>9.2.</b> Acta de aprobación del plan de trabajo por parte del COTECCU </p>
            <p style="margin-left: 130px"><b>9.3.</b> Evidencias de reunión (enlaces, fotografías y otros)  </p>
            <br> <br><br><br>
 
        </div>
    </div>

    


    <div id="footer">
        <p><span class="pagenum"></span></p>
      </div>
         
</body>
</html>