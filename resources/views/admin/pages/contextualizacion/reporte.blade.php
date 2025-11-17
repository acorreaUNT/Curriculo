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
            <b>3.2 CONTEXTUALIZACIÓN DEL PROGRAMA PROFESIONAL</b><br>
            <label><b>3.2.1 Sintesis del desarrollo histórico del Programa Profesional en la UNT:</b> </label>
            {!!$contextualizacion->sintesis!!}

            <label><b>3.2.2 Determinación y justificación de la necesidad y pertinencia social y laboral del Programa
                Profesional en el ámbito de influencia regional, nacional e internacional:</b> </label>
            {!!$contextualizacion->determinacion!!}

            <label><b>3.2.3 Desarrollo prospectivo del Programa Profesional:</b> </label>
            {!!$contextualizacion->desarrollo!!}
        </div>
    </div>
</body>
</html>