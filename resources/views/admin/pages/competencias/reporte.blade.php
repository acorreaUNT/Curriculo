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
        
    </style>
    
</head>
<body>
    <div class="row">
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
</body>
</html>