<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Cerfificados | DDA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b>GENERAR CONTRASEÑA</b></a>
  </div>
  <!-- User name -->
  @if (session('mensaje'))
  <div class="alert alert-dark alert-dismissible fade show">{{ session('mensaje') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>
@endif
  <div class="lockscreen-name">Ingrese su correo</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{asset('user.png')}}" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->
   
    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="{{route('generar.pass')}}" method="POST">
        @csrf
      <div class="input-group">
        <input type="email" name="email" class="form-control" placeholder="Correo Unitru" required>

        <div class="input-group-append">
          <button type="submit" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Ingrese su correo unitru, para que se le pueda enviar su contraseña o recuperarla
  </div>
  <div class="text-center">
    <a href="{{route('login')}}">O si ya tiene su contraseña inicie sesión</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2021 <b> <a target="_blank" href="https://www.ddadigital.online/">Dirección de Desarrollo Académico</a></b><br>
    Todos los Derechos Reservados
  </div>
    <div style="position: absolute; right: 20px; bottom: 20px;">
        <a href="{{route('login')}}" class="btn" style="background-color:#6ca333; 
        color:white; font-size: 25px; font-weight: bold;">
            Atrás</a>
    </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
