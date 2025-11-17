<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php 
    date_default_timezone_set('America/Lima');
    setlocale(LC_TIME, 'spanish'); ?>

    <style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            margin: 1cm;
            font-family: Arial, Helvetica, sans-serif !important;
        }
        .contenedor {
            position: relative;
            width: 100%;
            text-align: center;
        }
        .centrado {
            position: absolute;
            top: 52%;
            left: 50%;
            right: -60%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('./fondo-2.png'))) }}" width="100%">
        <div class="centrado" style="margin-top: 56px !important">
            <p style="font-weight: bolder !important; font-size: 20px !important;">UNIVERSIDAD NACIONAL DE TRUJILLO</p>
            <p style="font-weight: bolder !important; margin-top: -10px !important; font-size: 17px !important;">{{ mb_strtoupper($caratula->programa->facultad->nombre_facultad, 'utf-8') }}</p>
            <br><br>
            <p style="font-weight: bolder !important; font-size: 16px !important; background-color: {{ $caratula->color_fondo }}; color: {{ $caratula->color_letra }}; padding-top: 40px !important; padding-bottom: 40px !important; padding-left:10px; padding-right: 10px">CURRÍCULO DEL PROGRAMA DE ESTUDIOS DE  {{ mb_strtoupper($caratula->programa->nombre_programa, 'utf-8') }}</p>
            <br><br><br>
            <p style="font-weight: bolder !important; font-size: 14px !important">Modalidad educativa:</p>
            <p style="font-size: 14px !important; margin-top: -15px !important">Presencial</p>
            <br><br><br>
            <p style="font-weight: bolder !important; font-size: 14px !important">Aprobado por:</p>
            <p style="font-size: 14px !important; margin-top: -15px !important">R.C.F. N° {{ $caratula->rcf }}</p>
            <br><br><br>
            <p style="font-weight: bolder !important; font-size: 14px !important">Ratificado por:</p>
            <p style="font-size: 14px !important; margin-top: -15px !important">R.C.U. N° {{ $caratula->rcu }}</p>
            <br><br><br><br>
            <p style="font-weight: bolder !important; font-size: 15px !important;">TRUJILLO - PERÚ</p>
            <br>
            <p style="font-weight: bolder !important; font-size: 15px !important; margin-top: -30px !important">2024</p>
        </div>
    </div>
</body>
</html>
