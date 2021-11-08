<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Ruta</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>

	<div>

			<form id=registrar>
				
 				@csrf
 				<input type="number" id="cantidad" name="puertos_intermedios" placeholder="Catidad de puertos intermedios">
 				<br>
 				<br>
 				<input type="button" value="Aceptar" onclick="generarTabla()">
 				<div id="desplegar"></div>

			
			</form>

			    <br>
 				<br>

 			<label id="mensaje"></label>
		

	</div>

	<script>


		function generarTabla(){

			var cantidad = $("#cantidad").val();

			console.log(cantidad);

			var filas = (cantidad);

			var diferencia = filas-1;

			var final =parseFloat(filas)+parseFloat(diferencia);

			console.log(final);

			var tabla = "<table>";

			for (var i = 0; i <final; i++) {
				tabla+="<tr>";

				if ((i%2)==0) {
					tabla+="<td>Puerto</td><td><input type='text'></td>";


				}else{
					tabla+="<td>Duracion</td><td><input type='number'></td>";

				}
				tabla+="</tr>";
				console.log(i);

			}

			tabla+="</table>";

			$('#desplegar').html(tabla);
				



		}


		function registrar() {



			$.ajax({

			    type: 'POST',

			    url: "{{url('ruta/registrar')}}",
			    
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