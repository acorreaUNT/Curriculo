@extends('admin.layouts._principal')

@section('css')
    <style>
        .verticalText {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            max-height: 40% !important;
        }
        table {
            table-layout: fixed;
            text-align:center;
            margin-left: auto;
            margin-right: auto;
            empty-cells: show;
        }
        <style>
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
        .ESPECÍFICO{
            background-color: #F76725;
        }
        .ESPECIALIDAD{
            background-color: #41BCC3;
        }
        .GENERAL{
            background-color: #5FC341 !important;
        }
        .EXTRACURRICULAR{
            background-color: #5FC341;
        }
    </style>

    
@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Mapa Curricular</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item"><a href="{{route('mapa.curricular')}}">Lista de Mapa</a></li>
            <li class="breadcrumb-item active">Mapa curricular</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
         <div class="row">
            <h5>Mapa de {{$tipo->nombre}}</h5>
          </div>
        </div>
        <!-- /.card-header -->
        <form action="{{route('relacion.mapa.curricular')}}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <input type="hidden" name="id_programa_estudio" value="{{$programa_estudio->id}}">
                <input type="hidden" name="id_tipo_competencia" value="{{$tipo->id}}">
            <table class="table table-bordered table-striped" cellspacing="0"  style="font-size: 10px;width:100%;border-collapse:collapse;">
                <thead style="background-color: #FFCB88 !important">
                    <tr class="GridViewScrollHeader">
                        <td></td>
                        <td></td>
                        @foreach ($competencias as $item)
                            <?php $celda = count(\App\Models\Capacidades::where('id_competencia', $item->id)->get()) ?>
                            <td colspan="{{$celda}}">{{$item->contenido}}</td>
                        @endforeach
                    </tr>
                    <tr class="GridViewScrollHeader"> 
                        <td class="verticalText">COD. ASIGN</td>
                        <td class="verticalText">Nombre de la asignatura</td>
                        @foreach ($competencias as $row)
                            <?php $capacidades = \App\Models\Capacidades::where('id_competencia', $row->id)->get() ?>
                            @foreach ($capacidades as $aux)
                                <td class="verticalText">{{$aux->contenido}}</td>
                            @endforeach
                        @endforeach
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($cursos as $value => $aux2)
                            <tr  class="GridViewScrollItem">
                                <td>{{$value = $value + 1}}</td>
                                <?php $c= 0; $continuacion = stristr($aux2->nombre, 'ACTIVIDAD EXTRACURRICULAR'); ?>
                                @if ($c>=1 && $continuacion)
                                    
                                @endif
                                <td class="{{$aux2->tipo}}">{{$aux2->nombre}}</td>
                                @foreach ($tcapacidades as $aux3)
                                    <?php $verificar = count(\App\Models\MapaCurricular::where('id_capacidad', $aux3->id)
                                                        ->where('id_curso_plan_estudios', $aux2->id)->get()); ?>
                                    @if ($verificar==1)
                                        <td><input type="checkbox" checked name="relacion[]" value="{{$aux2->id}},{{$aux3->id}}"></td>
                                    @else
                                        <td><input type="checkbox" name="relacion[]" value="{{$aux2->id}},{{$aux3->id}}"></td>
                                    @endif
                                    
                                @endforeach
                                @if ($continuacion)
                                    <?php $c++ ?>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <!--
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-success btn-block">GUARDAR</button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>-->
            </div>
        </form>
        <!-- /.card-body -->
    </div>   
</div>
@endsection

@section('scripts')
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
<script type="text/javascript" src="{{asset('js/gridviewscroll.js')}}"></script>
<script type="text/javascript">
    var gridViewScroll = null;
    window.onload = function () {
        var options = new GridViewScrollOptions();
        options.elementID = "gvMain";
        options.width = 450;
        options.height = 300;
        options.freezeColumn = true;
        options.freezeFooter = true;
        options.freezeColumnCssClass = "GridViewScrollItemFreeze";
        options.freezeFooterCssClass = "GridViewScrollFooterFreeze";
        options.freezeColumnCount = 2;

        gridViewScroll = new GridViewScroll(options);
        gridViewScroll.enhance();

        options.elementID = "gvMain2";
        var gridViewScroll2 = new GridViewScroll(options);
        gridViewScroll2.enhance();

        options.elementID = "gvMain3";
        options.width = 600;
        var gridViewScroll3 = new GridViewScroll(options);
        gridViewScroll3.enhance();

        options.elementID = "gvMain4";
        var gridViewScroll4 = new GridViewScroll(options);
        gridViewScroll4.enhance();
    }
    function enhance() {
        gridViewScroll.enhance();
    }
    function undo() {
        gridViewScroll.undo();
    }
</script>
@endsection