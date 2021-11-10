<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href={{ asset('image/icons/favicon.icon') }} />
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href={{ asset('vendor/bootstrap/css/bootstrap.min.css') }}> 
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href={{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}> 
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}> 
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/animate/animate.css') }}>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/css-hamburgers/hamburgers.min.css') }}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/animsition/css/animsition.min.css') }}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/select2/select2.min.css') }}>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/daterangepicker/daterangepicker.css') }}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{ asset('css/util.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('css/main.css') }}>
<!--===============================================================================================-->
</head>
<body>
	<header>
		<div class="header_logo">
			<img  src="https://i.ibb.co/YBXtBjR/logo.png" width="270px"/>
		</div>
	</header>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-70">
						Bienvenido
					</span>

					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Usuario">
						<input class="input100" type="text" name="user"> 
						<span class="focus-input100" data-placeholder="Usuario"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Contrasena">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Contrasena"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Iniciar
						</button>
					</div>

					<ul class="login-more p-t-190">
						<li>
							<span class="txt1">
								No tiene un usuario?
							</span>

							<a href="http://127.0.0.1:8000/usuario/registrar" class="txt2">
								Crear Usuario
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>	
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
