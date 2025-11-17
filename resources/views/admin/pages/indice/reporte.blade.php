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
    </style>
    
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center" style="font-size: 16px !important"><b>ÍNDICE</b></h1> <br>
            <table class="" style="width: 100% !important">
                <tbody>                   
                    <tr >
                        <td>PRESENTACIÓN ..........................................................................................................................................................................</td>
                        <td>{{$indice->n_presentacion}}</td>
                    </tr>
                    <tr >
                        <td style="margin-top: 7px !important">INTRODUCCIÓN ..........................................................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">{{$indice->n_introduccion}}</td>
                    </tr>
                    <tr>
                        <td  style="margin-top: 7px !important">BASES GENERALES ...................................................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">{{$indice->n_bases_generales}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important"> - BASES NORMATIVAS ......................................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">{{$indice->n_bases_normativas}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important"> - BASES INSTITUCIONALES  .............................................................................................................................................</td>
                        <td  style="margin-top: 7px !important">{{$indice->n_bases_institucionales}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important"> - BASES TEÓRICO - CONCEPTUALES ............................................................................................................................</td>
                        <td  style="margin-top: 7px !important">{{$indice->n_bases_teorica}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">ESTUDIO DE LA DEMANDA SOCIAL Y EL MERCADO LABORAL ............................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_estudio_demanda}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">OBJETIVOS EDUCACIONALES ...................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_obj_educacionales}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important" >EJES CURRICULARES TRANSVERSALES .................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_ejes_curriculares}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">COMPETENCIAS ...........................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_competencias}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- GENÉRICAS  .......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_genericas}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- ESPECÍFICAS .....................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_especificas}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">PERFILES ......................................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_perfiles}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- DE INGRESO ......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_perfil_ingreso}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- DE EGRESO .......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_perfil_egreso}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">MAPA CURRICULAR ......................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_mapa_curricular}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">MALLA CURRICULAR ....................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_malla_curricular}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">PLAN DE ESTUDIOS .....................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_plan_estudios}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">SUMILLAS ......................................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_sumilla}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">ESTRATEGIAS DE ENSEÑANZA APRENDIZAJE EN ENFOQUE POR COMPETENCIAS .........................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_estrategias_ensenanza}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">LINEAMIENTOS DE GESTIÓN CURRICULAR ..............................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_lineamientos}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">SISTEMA DE EVALUACIÓN ..........................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_sistema_evaluacion}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- EVALUACIÓN DE LOS APRENDIZAJES ..........................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_eval_aprendizaje}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- EVALUACIÓN DEL LOGRO DE COMPETENCIAS ............................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_eval_logro}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px; margin-top: 7px !important">- EVALUACIÓN CURRICULAR ............................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_eval_curricular}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">REFERENCIAS BIBLIOGRÁFICAS ...............................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_referencias}}</td>
                    </tr>
                    <tr>
                        <td style="margin-top: 7px !important">ANEXOS ........................................................................................................................................................................................</td>
                        <td style="margin-top: 7px !important">{{$indice->n_anexos}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>