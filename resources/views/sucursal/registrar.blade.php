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
				<input type="text" name="nombre" placeholder="Nombre" required class="input">
				<br>
				<br>
				<input type="text" name="ciudad" placeholder="Ciudad" required class="input">
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
			    	if(data==true){
			    		$('#mensaje').html('Se agrego exitosamente');
			    		//$('form#registrar').trigger("reset");
			    	}else{
			    		$('#mensaje').html('Compruebe los datos ingresados');
			    	}
			    },
			    
			    error: function(data) {
			        $('#mensaje').html('Error en el servidor');
			    },
			    
			    timeout:5000
			});
			

		}

	</script>


</body>
</html>