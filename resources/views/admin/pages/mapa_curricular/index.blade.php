@extends('admin.layouts._principal')

@section('css')

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
            <li class="breadcrumb-item active">Mapa curricular</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('contenido')
<div class="container">
    <div class="card">
        <div class="card-header">
         <div class="row">
            <h5>Seleccione el mapa a llenar</h5>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo de Competencia</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipo_competencias as $value => $item)
                    <tr>
                        <td>{{$value = $value + 1 }}</td>
                        <td>Mapa de {{$item->nombre}}</td>
                        <td>
                            <a href="{{route('mapa.currilar.llenar', encrypt($item->id))}}"
                                class="btn btn-success">
                                <i class="fa fa-indent"></i> INGRESAR</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>   
</div>
@endsection

@section('scripts')
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
@endsection