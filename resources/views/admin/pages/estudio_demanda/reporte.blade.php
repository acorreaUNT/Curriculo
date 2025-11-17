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
</body>
</html>