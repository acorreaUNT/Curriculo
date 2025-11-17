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
        .centrado{
            text-align: center;
            font-weight: bold;
            vertical-align:middle !important;
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
        .centrar{
            text-align: center;
            vertical-align:middle !important;
        }
    </style>
    
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <b>9. PLAN DE ESTUDIOS </b> <br><br>
            <table class="table" border="1" style="font-size: 9px !important">
                    <tr>
                        <td rowspan="2" class="centrado">CICLO</td>
                        <td rowspan="2" class="centrado">CÓDIGO</td>
                        <td rowspan="2" class="centrado">ASIGNATURA</td>
                        <td rowspan="2" class="centrado" style="width:9%">TIPO(G,E,S)</td>
                        <td colspan="3" class="centrado">HORAS SEMANALES</td>
                        <td rowspan="2" style="width:1%" class="centrado">CRÉDITOS</td>
                        <td rowspan="2" class="centrado">REQUISITOS</td>
                        <td rowspan="2" style="width:25%" class="centrado">DPTO. QUE ATIENDE</td>
                    </tr>
                    <tr>
                        <td class="centrado" style="width:5%">Teoría</td>
                        <td class="centrado" style="width:5%"> Práctica</td>
                        <td class="centrado" style="width:5%">Total</td>
                    </tr>
                <tbody>
                    @for ($i = 0; $i < $plan_estudio->programa->num_ciclos; $i++)
                        <?php $total_ht = 0; $total_hp = 0; $total_creditos = 0; ?>
                        <?php $cursos = App\Models\CursosPlanEstudios::where('ciclo', $plan_estudio->a_romano($i + 1) )
                          ->where('id_plan_estudio', $plan_estudio->id)->get();  ?>
                           <?php $curso_extra = App\Models\CursosPlanEstudios::where('ciclo', $plan_estudio->a_romano($i + 1) )
                           ->where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'EXTRACURRICULAR')->get();  ?>
                        <?php $totales_curso = count($cursos2) ?>
                        <?php $total_extra =  count($curso_extra) ?>
                        <?php
                            foreach ($cursos as $value) {
                              $total_ht = $total_ht + $value->ht;
                              $total_hp = $total_hp + $value->hp;
                              $total_creditos = $total_creditos + $value->creditos;
                            }
                        ?>
                        @foreach ($cursos as $item)
                            @if ($item->ciclo == $plan_estudio->a_romano($i + 1))
                                <tr class="{{$item->eliminar_tildes(utf8_decode($item->tipo))}}">
                                    <td class="centrar">{{$item->ciclo}}</td>
                                    <td></td>
                                    <td class="centrar">{{$item->nombre}}
                                        @if ($item->tipo == 'EXTRACURRICULAR' && $total_extra>1)
                                            <b>(ESCOGER SOLO 1)</b>
                                        @endif
                                    </td>
                                    <td class="centrar">
                                        @if ($item->tipo == 'GENERAL')
                                            <?php echo 'G' ?>
                                        @endif
                                        @if ($item->tipo == 'EXTRACURRICULAR')
                                            <?php echo 'G' ?>
                                        @endif
                                        @if ($item->tipo == 'ESPECÍFICO')
                                            <?php echo 'E' ?>
                                        @endif
                                        @if ($item->tipo == 'ESPECIALIDAD')
                                            <?php echo 'S' ?>
                                        @endif
                                    </td>
                                    <td class="centrar">{{$item->ht}}</td>
                                    <td class="centrar">{{$item->hp}}</td>
                                    <td class="centrar">{{$item->h_semana}}</td>
                                    <td class="centrar">{{$item->creditos}}</td>
                                    <td>
                                        <?php $requisitos = \App\Models\CursoRequisito::where('id_curso', $item->id)->get() ?>
                                            <ul>
                                                @foreach ($requisitos as $row)
                                                    <li>{{$row->requisito->nombre}}</li>
                                                @endforeach
                                            </ul>
                                    </td>
                                    <td>
                                        <?php $departamentos = \App\Models\CursoDepartamento::where('id_curso', $item->id)->get() ?>
                                            <ul>
                                                @foreach ($departamentos as $item2)
                                                    <li>{{$item2->departamento->nombre_departamento}}</li>
                                                @endforeach
                                            </ul>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                       
                        <tr class="centrado">
                            <td colspan="3"></td>
                            <td>TOTALES</td>
                            <td>{{$total_ht}}</td>
                            <td>{{$total_hp}}</td>
                            <td>{{$total_ht + $total_hp }}</td>
                            <td>{{$total_creditos}}</td>
                            <td></td>
                            <td></td>
                        </tr>

                    @endfor
                </tbody>
            </table>
<br>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="justify-content: center !important; margin-left: 110px !important">
                  
                  <?php $curso_generales = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'GENERAL')->get();?>
                  <?php $curso_ext = App\Models\CursosPlanEstudios::distinct('ciclo')->where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'EXTRACURRICULAR')->get();?>
                  <?php $curso_esp = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECÍFICO')->get();?>
                  <?php $curso_espec = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECIALIDAD')->get();?>
                  <?php $t_curso_generales = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'GENERAL')->get());?>
                  <?php $t_curso_ext = App\Models\CursosPlanEstudios::distinct('ciclo')->where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'EXTRACURRICULAR')->count('id');?>
                  <?php $t_curso_esp = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECÍFICO')->get());?>
                  <?php $t_curso_espec = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECIALIDAD')->get());?>
                  <?php $total_asignaturas = $t_curso_generales + $t_curso_ext + $t_curso_esp + $t_curso_espec; ?>
                  <?php $total_horas = $curso_generales->sum('h_semana') + $curso_ext->sum('h_semana') + $curso_esp->sum('h_semana') + $curso_espec->sum('h_semana'); ?>
                  <?php $total_creditos = $curso_generales->sum('creditos') + $curso_esp->sum('creditos') + $curso_espec->sum('creditos'); ?>
                 
                  <table class="table centrar">
                    
                      <tr style="background-color: #ECE4D9">
                        <td>TIPO DE ESTUDIOS</td>
                        <td>N° ASIGNATURAS</td>
                        <td>N° HORAS</td>
                        <td>%</td>
                        <td>N° CRÉDITOS</td>
                        <td>%</td>
                      </tr>
                
                    <tbody>
                      <tr style="background-color: #5FC341; ">
                        <td>ESTUDIOS GENERALES (G)</td>
                        <td>{{$t_curso_generales + $t_curso_ext}}</td>
                        <td>{{$curso_generales->sum('h_semana') + $curso_ext->sum('h_semana') }}</td>
                        <td>@if (($curso_generales->sum('h_semana') + $curso_ext->sum('h_semana'))>0)
                          {{ $porcT1 = round(((($curso_generales->sum('h_semana') + $curso_ext->sum('h_semana'))/$total_horas) * 100),2) }}
                          @else
                          {{$porcT1 = 0}}
                        @endif</td>
                        <td>{{$curso_generales->sum('creditos')}}</td>
                        <td>@if ($curso_generales->sum('creditos')>0)
                          {{$porcC1 = round(((($curso_generales->sum('creditos'))/$total_creditos) * 100),2) }}
                        @else
                        {{$porcC1 = 0 }}
                        @endif
                          
                        </td>
                      </tr>
                      <tr style="background-color: #F76725;">
                        <td>ESTUDIOS ESPECÍFICOS (E)</td>
                        <td>{{$t_curso_esp}}</td>
                        <td>{{$curso_esp->sum('h_semana')}}</td>
                        <td>@if ($curso_esp->sum('h_semana')>0)
                          {{$porcT2 = round(((($curso_esp->sum('h_semana'))/$total_horas) * 100),2) }}
                        @else
                        {{$porcT2 = 0 }}
                        @endif
                          
                        </td>
                        <td>{{$curso_esp->sum('creditos')}}</td>
                        <td>@if ($curso_esp->sum('creditos')>0)
                          {{$porcC2 = round(((($curso_esp->sum('creditos'))/$total_creditos) * 100),2) }}
                        @else
                        {{$porcC2 = 0 }}
                        @endif
                          
                        </td>
                      </tr>
                      <tr style="background-color: #41BCC3;">
                        <td>ESTUDIOS DE ESPECIALIDAD (S)</td>
                        <td>{{$t_curso_espec}}</td>
                        <td>{{$curso_espec->sum('h_semana')}}</td>
                        <td>@if ($curso_espec->sum('h_semana')>0)
                          {{$porcT3 = round(((($curso_espec->sum('h_semana'))/$total_horas) * 100),2)}}
                        @else
                        {{$porcT3 = 0}}
                        @endif
                          
                        </td>
                        <td>{{$curso_espec->sum('creditos')}}</td>
                        <td>@if ($curso_espec->sum('creditos')>0)
                          {{$porcC3 = round(((($curso_espec->sum('creditos'))/$total_creditos) * 100),2) }}
                        @else
                        {{$porcC3 = 0 }}
                        @endif
                         
                        </td>
                      </tr>
                      <tr style="background-color: #ECE4D9">
                        <td><b>TOTAL</b></td>
                        <td>{{$total_asignaturas}}</td>
                        <td>{{$total_horas}}</td>
                        <td>{{$porcT1 + $porcT2 + $porcT3}}</td>
                        <td>{{$total_creditos}}</td>
                        <td>{{$porcC1 + $porcC2 + $porcC3}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-sm-2"></div>
              </div>
            
        </div>
    </div>
</body>
</html>