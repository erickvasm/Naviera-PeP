<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Nave</title>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>

	<div>

			<form id=registrar class="form-imputs">
				
 				@csrf
				 <h2 class="title" >Registro de naves</h2>
				
 				<input type="text" name="nombre" placeholder="Nombre" required class="input"> 
 				<br>
 				<br>
	
 				<input type="number" name="capacidad_pasajeros" min="1" placeholder="Capacidad de pasajeros" class="input" required>
 				<br>
 				<br>

 				<input type="number" name="capacidad_carga" min="1" placeholder="Capacidad de cargar" class="input" required>
 				<br>
 				<br>
 				<input type="button" onclick="registrar()" value="Registrar" class="button">

				 <br>
				 <br>

				 <label id="mensaje" class="labels"></label>
			</form>


 			
		

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