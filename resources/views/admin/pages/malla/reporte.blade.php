<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
 integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?php 
    date_default_timezone_set('America/Lima');
    setlocale(LC_TIME, 'spanish'); ?>

    <style>
        
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
        .contenedor2{
            position: absolute;
            display: inline-block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="contenedor2" style="margin: 0cm 0cm 0cm 0cm !important">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('mallas/'.$malla->malla))) }}" width="90%">
    </div>
</body>
</html>