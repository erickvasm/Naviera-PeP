<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Nave</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>

	<div>

			<form id=registrar>
				
 				@csrf
 				<input type="text" name="nombre" placeholder="Nombre" required>
 				<br>
 				<br>
 				<input type="number" name="capacidad_pasajeros" placeholder="Capacidad de pasajeros" required>
 				<br>
 				<br>
 				<input type="number" name="capacidad_carga" placeholder="Capacidad de cargar" required>
 				<br>
 				<br>
 				<input type="button" onclick="registrar()" value="Registrar">

			
			</form>

			    <br>
 				<br>

 			<label id="mensaje"></label>
		

	</div>

	<script>

		function registrar() {



			$.ajax({

			    type: 'POST',

			    url: "{{url('nave/registrar')}}",
			    
			    data: $("#registrar").serialize(),
			    
			    success: function(data) {
			    	if(data==true){
			    		$('#mensaje').html('Nave agregada correctamente');
			    		$('form#registrar').trigger("reset");
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