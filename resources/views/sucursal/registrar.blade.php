<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Sucursal</title>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>


	<div>

		<form id="registrar" class="form-imputs">
			
			@csrf
			<h2 class="title" >Registro Sucursal</h2>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre" required class="input">
				<br>
				<br>
				<input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required class="input">
				<br>
				<br>
				<input type="button" onclick="registrar()" value ="Registrar"/ class="button">

				<br>
				<br>
		
				<label id="mensaje" class="labels"></label>
		</form>

		

	</div>

	
	<script>

		function registrar() {



			$.ajax({

			    type: 'POST',

			    url: "{{url('sucursal/registrar')}}",
			    
			    data: $("#registrar").serialize(),
			    
			    success: function(data) {
			    	if(data!=''){

			    		limpiarCampos();
			    		
			    		mensaje("Se agrego exitosamente")
			    		
			    	}else{
			    		mensaje("Verifique los datos ingresados")
			    	}
			    },
			    
			    error: function(data) {
			        mensaje("Error en el servidor");
			    },
			    
			    timeout:5000
			});
			

		}

		function limpiarCampos(){

			$("#ciudad").val(null);
			$("#nombre").val(null);

		}


		function mensaje(mensaje){
			$("#mensaje").html(mensaje);
		}

	</script>


</body>
</html>