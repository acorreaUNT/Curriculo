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
        .gris{
            font-weight: bold;
            background-color: #d9d9d9;
        }
        .borde{
            border: 1px solid black;
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
    </style>
    
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <b>10. SUMILLAS </b><br><br>
            @foreach ($sumillas as $item)
            <table class="table borde">
                <tr class="text-center borde {{$item->eliminar_tildes(utf8_decode($item->curso->tipo))}}" >
                    <td colspan="11" class="borde"><b>ASIGNATURA: {{mb_strtoupper($item->curso->nombre,'utf-8')}}</b> </td>
                </tr>
                <tr>
                   <td class="gris borde">Ciclo </td>
                   <td class="borde">{{$item->curso->ciclo}}</td>
                   <td class="gris borde">Código: </td>
                   <td class="borde">{{$item->curso->codigo}}</td>
                   <td class="gris borde">Naturaleza: </td>
                   <td class="borde">{{$item->curso->naturaleza}}</td>
                   <td class="gris borde">Requisito:</td>
                   <td class="borde" colspan="3">
                       <?php $requisitos = \App\Models\CursoRequisito::where('id_curso', $item->curso->id)->get() ?>
                       @if (count($requisitos)>=2)
                           <ul>
                               @foreach ($requisitos as $row)
                                   <li>{{$row->requisito->nombre}}</li>
                               @endforeach
                           </ul>
                       @else
                           @foreach ($requisitos as $row)
                               {{$row->requisito->nombre}}
                           @endforeach
                       @endif
                   </td>
                   <td class="gris borde">Código de la Capacidad: </td>
                </tr>
                <tr>
                    <td class="gris borde">Total horas</td>
                    <td class="borde">{{$item->curso->total_h}}</td>
                    <td class="gris borde">Horas por semana</td>
                    <td class="borde">{{$item->curso->h_semana}}</td>
                    <td class="gris borde">Créditos</td>
                    <td class="borde">{{$item->curso->creditos}}</td>
                    <td class="gris borde">HT</td>
                    <td class="borde">{{$item->curso->ht}}</td>
                    <td class="gris borde">HP</td>
                    <td class="borde">{{$item->curso->hp}}</td>
                    <td class="borde">{{$item->curso->codigo_capacitaciones}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="gris borde">Sumilla</td>
                    <td colspan="9" class="borde">
                        {{$item->contenido_sumillas}}
                    </td>
                </tr>
                <tr>
                   <td colspan="2" class="gris borde">Ejes Transversales</td>
                   <td colspan="9" class="borde">
                        {{$item->ejes_transversales}}
                   </td>
               </tr>
               <tr>
                   <td colspan="2" class="gris borde">Departamento(s)
                       Académico(s)
                       Responsable (s)</td>
                   <td colspan="3" class="borde">
                    <?php $departamentos = \App\Models\CursoDepartamento::where('id_curso', $item->curso->id)->get() ?>
                       @if (count($departamentos)>=2)
                           <ul>
                               @foreach ($departamentos as $item2)
                                   <li>{{$item2->departamento->nombre_departamento}}</li>
                               @endforeach
                           </ul>
                       @else
                           @foreach ($departamentos as $item2)
                               {{$item2->departamento->nombre_departamento}}
                           @endforeach
                       @endif
                   </td>
                   <td colspan="2" class="gris borde">Perfil específico
                       del docente /
                       equipo formador</td>
                   <td colspan="4" class="borde">
                     {{$item->perfil_docente}}
                   </td>
               </tr>
             </table>
                <div style="page-break-before: always;"></div>
            @endforeach
        </div>
    </div>
</body>
</html>