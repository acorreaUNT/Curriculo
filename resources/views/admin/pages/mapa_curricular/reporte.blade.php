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
        @page {
               margin: 2.0cm 2.0cm 2.0cm 2.0cm;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px !important;
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
        .verticalText {
            writing-mode: vertical-rl;
            transform: rotate(270deg);
           
        }
        table {
            table-layout: fixed;
            text-align:center;
            margin-left: auto;
            margin-right: auto;
            empty-cells: show;
        }
       
    </style>
    
</head>
<body>
    
   <div class="row">
       <div class="col-sm-12">
            <b>7.1. COMPETENCIAS GENERALES</b> <br> <br>
            <table class="table table-bordered table-striped" cellspacing="0"  style="font-size: 7px !important;width:100%;border-collapse:collapse;">
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
</body>
</html>