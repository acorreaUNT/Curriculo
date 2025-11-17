<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Interno | DPA</title>
    <meta name="description" content="Direccion de Desarrollo Académico">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('plantilla_login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                    @csrf
					<span class="login100-form-title p-b-43">
						Inicio de Sesión
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Correo es requerido: ex@abc.xyz">
						<input class="input100 @error('email') is-invalid @enderror" type="text"  name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Correo</span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Contraseña es requerida">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Recuerdame
							</label>
						</div>

						<div>
							<!--<a href="#" class="txt1">
								Recuperar Contraseña
							</a>-->
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							INGRESAR
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Dirección de Procesos Académicos
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="https://www.facebook.com/DPAUNT2021" target="_blank"
                         class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="https://www.ddadigital.online/" target="_blank" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-globe" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('plantilla_login/images/bg-3.png');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="{{asset('plantilla_login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('plantilla_login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('plantilla_login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('plantilla_login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('plantilla_login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('plantilla_login/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('plantilla_login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('plantilla_login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('plantilla_login/js/main.js')}}"></script>

</body>
</html>