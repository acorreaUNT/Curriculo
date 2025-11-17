@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Sumillas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Sumillas</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('contenido')
<div class="container">
    @if (isset($plan_estudio))
    <div class="card">
        <div class="card-header">
         <div class="row">
            <h5>Complete las sumillas que se encuentran en estado "PENDIENTE"</h5>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ciclo</th>
                    <th>Asignatura</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sumillas as $value => $item)
                    <tr>
                        <td>{{$value = $value + 1 }}</td>
                        <td>{{$item->curso->ciclo}}</td>
                        <td>{{$item->curso->nombre}}</td>
                        <td>
                            @if ($item->contenido_sumillas == NULL || $item->ejes_transversales == NULL || $item->perfil_docente==NULL)
                                 <span class="badge badge-warning">PENDIENTE</span>
                            @else
                                <span class="badge badge-success">COMPLETADO</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('sumilla.llenar', encrypt($item->id))}}"
                                class="btn btn-dark">
                                <i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    @else
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <h1 align="center">DEBE LLENAR PRIMERAMENTE SU PLAN DE ESTUDIOS</h1>
        </div>
        <!-- /.card-body -->
    </div>
    @endif
    
</div>
@endsection

@section('scripts')
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
@endsection