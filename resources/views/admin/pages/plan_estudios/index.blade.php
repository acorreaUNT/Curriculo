@extends('admin.layouts._principal')

@section('css')
 <style>
   table{
     text-align: center
   }
 </style>
@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Plan de Estudios</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Plan de Estudios</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('contenido')
<div class="container">
              <?php
                if($plan_estudio->programa->num_ciclos == 10) {
                  $creditaje_general = 35;
                  $creditaje_especifico = 53;
                  $creditaje_especialidad = 132;
                  $total_creditaje = 220;
                } 
                if($plan_estudio->programa->num_ciclos == 12) {
                  $creditaje_general = 35;
                  $creditaje_especifico = 67;
                  $creditaje_especialidad = 162;
                  $total_creditaje = 264;
                } 
                if($plan_estudio->programa->num_ciclos == 14) {
                  $creditaje_general = 35;
                  $creditaje_especifico = 81;
                  $creditaje_especialidad = 192;
                  $total_creditaje = 308;
                } 
              ?>
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-12" align="center">
              <h2>NÚMERO DE CICLOS: {{ $plan_estudio->programa->num_ciclos}} </h2> <br>
              <h4>CREDITAJE ÓPTIMO:  Generales: {{ $creditaje_general}} | Específicos: {{ $creditaje_especifico}} | Especialidad: {{ $creditaje_especialidad}} | 
                <b>TOTAL: {{$total_creditaje}}</b></h4> 
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              
              <?php $curso_generales = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'GENERAL')->where('estado',null)->get();?>
              <?php $curso_ext = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'EXTRACURRICULAR')->get();?>
              <?php $curso_esp = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECÍFICO')->get();?>
              <?php $curso_espec = App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECIALIDAD')->get();?>
              <?php $t_curso_generales = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'GENERAL')->get());?>
              <?php $t_curso_ext = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'EXTRACURRICULAR')->get());?>
              <?php $t_curso_esp = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECÍFICO')->get());?>
              <?php $t_curso_espec = count(App\Models\CursosPlanEstudios::where('id_plan_estudio', $plan_estudio->id)->where('tipo', 'ESPECIALIDAD')->get());?>
              <?php $total_asignaturas = $t_curso_generales + $t_curso_ext + $t_curso_esp + $t_curso_espec; ?>
              <?php $total_horas = $curso_generales->sum('h_semana') + $curso_ext->sum('h_semana') + $curso_esp->sum('h_semana') + $curso_espec->sum('h_semana'); ?>
              <?php $total_creditos = $curso_generales->sum('creditos') + $curso_esp->sum('creditos') + $curso_espec->sum('creditos'); ?>
             
              <table class="table">
                <thead>
                  <tr style="background-color: #ECE4D9">
                    <td>TIPO DE ESTUDIOS</td>
                    <td>N° ASIGNATURAS</td>
                    <td>N° HORAS</td>
                    <td>%</td>
                    <td>N° CRÉDITOS</td>
                    <td>%</td>
                  </tr>
                </thead>
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
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ciclo</th>
                    <th>Total HT</th>
                    <th>Total HP</th>
                    <th>Total Horas Semanales</th>
                    <th>Total Créditos</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < $plan_estudio->programa->num_ciclos; $i++)
                        <?php $total_ht = 0; $total_hp = 0; $total_creditos = 0; ?>
                        <?php $cursos = App\Models\CursosPlanEstudios::where('ciclo', $plan_estudio->a_romano($i + 1))
                        ->where('id_plan_estudio', $plan_estudio->id)
                        ->where(function($query) {
                            $query->whereIn('estado', ['obligatorio', 'electivo'])
                                  ->orWhereNull('estado');
                        })
                        ->get();  ?>
                        <?php
                            foreach ($cursos as $value) {
                              $total_ht = $total_ht + $value->ht;
                              $total_hp = $total_hp + $value->hp;
                              $total_creditos = $total_creditos + $value->creditos;
                            }
                        ?>
                    <tr>
                        <td></td>
                        <td>{{$plan_estudio->a_romano($i + 1)}}</td>
                        <td>{{$total_ht}}</td>
                        <td>{{$total_hp}}</td>
                        <td>{{$total_ht + $total_hp}}</td>
                        <td>{{$total_creditos}}</td>
                        <td>@if ($total_creditos>=20 && $total_creditos<=23)
                          <span class="badge badge-success">COMPLETADO</span>
                        @else
                        <span class="badge badge-warning">PENDIENTE</span>
                        @endif</td>
                    </tr>
                @endfor
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    
    
</div>
@endsection

@section('scripts')
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
@endsection