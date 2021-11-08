<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Usuario</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.js') }}"></script>
</head>
<body>


	<div>

		<form id="registrar">
			
			@csrf
				

				Rol:<select name="tipo">
					<option value="true">Gerente</option>
					<option value="false">Cajero</option>
				</select>

				<br>
				<br>

				Nombre:<input type="text" id="nombre" name="nombre" placeholder="Nombre" required>


				<br>
				<br>

				Clave:<input type="password" id="clave" name="clave" placeholder="Clave" required>
				
				<br>
				<br>

				Confirmar Clave:<input type="password" id="clave-confirm" name="clave-confirm" placeholder="Clave" required>

				<br>
				<br>
				
				<input type="submit" value ="Registrar"/>

		</form>

		<br>
		<br>
		
		<label id="mensaje"></label>

	</div>

	
	<script>



		$("form[id='registrar']").validate({

			rules:{

				nombre:{
					min-length:3
				}

				clave:{
					min-length:5
				},
				clave-confirm:{
					min-length:5,
					equalTo:'[name="clave"]'
				}

			},
			submitHandler:function(form) {
				enviarPeticion();
			}

		});



		function enviarPeticion() {
				

			$.ajax({

			    type: 'POST',

				url: "{{url('usuario/registrar')}}",
				    
				data: $("#registrar").serialize(),
				    
				success: function(data) {
					if(data==true){
				    	$('#mensaje').html('Se agrego exitosamente');
				    	$('form#registrar').trigger("reset");
				    }else{
				    	$('#mensaje').html('Compruebe los datos ingresados');
				    }
					},
				    
				   error: function(data) {
				       $('#mensaje').html('Error en elservidor');
				   },

				   timeout:5000

				});


			}
			

	</script>


</body>
</html>