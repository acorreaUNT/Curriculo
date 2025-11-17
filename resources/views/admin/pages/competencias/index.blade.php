@extends('admin.layouts._principal')

@section('css')

@endsection

@section('titulo')

<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Competencias</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Panel</a></li>
            <li class="breadcrumb-item active">Competencias</li>
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
           <div class="col-sm-9">
            <h5>Ingrese a la competencia</h5>
           </div>
           <!--
            <div class="col-sm-3">
              <a href="{{route('asignaturas')}}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Asignaturas</a>
            </div>-->
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
                        <td>{{$item->nombre}}</td>
                        <td>
                            <a href="{{route('competencias.llenar', encrypt($item->id))}}"
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