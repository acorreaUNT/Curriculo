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
</body>
</html>