<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Ruta</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>

	<div>

			<form id='registrar' action='#'>
				
 				@csrf
 				<input type="number" id="cantidad" min="2" name="puertos_intermedios" placeholder="Catidad de puertos intermedios">
 				
 				<br>
 				<br>
 				
 				<input type="button" value="Ingresar Puertos Intermedios" onclick="generarTabla()">

 				<br>
 				<br>
 				

 				<div id="desplegar"></div>

 				<br>
 				<br>

 				<input type="button" value="Registrar Ruta" onclick="enviarPeticion()">
			
			</form>

			    <br>
 				<br>

 			<label id="mensaje"></label>
		

	</div>

	<script>


		function generarTabla(){

			var cantidad = $("#cantidad").val();

			if(cantidad>1) {

				var filas = (cantidad);
				var diferencia = filas-1;
				var final =parseFloat(filas)+parseFloat(diferencia);

				var tabla = "<table id='tablaPuertos'>";

				for (var i = 0; i <final; i++) {
					tabla+="<tr>";

					if ((i%2)==0) {
						tabla+="<td>Puerto</td><td><input type='text' value='xD' id='fila"+i+"'></td>";


					}else{
						tabla+="<td>Duracion</td><td><input value='2' type='number' id='fila"+i+"'></td>";

					}
					tabla+="</tr>";

				}

				tabla+="</table>";

				$('#desplegar').html(tabla);

			}

			obtenerDatosDeTabla();

		
				



		}


		function enviarPeticion() {

			if($('#tablaPuertos tr').length>1) {

				var datos = obtenerDatosDeTabla();
				
				var duraciones = datos[1];
				var puertos = datos[0];

				$.ajax({

				    type: 'POST',

				    url: "{{url('ruta/registrar')}}",
				    
				    data: {"_token": "{{ csrf_token() }}",'puertos':puertos,'duraciones':duraciones},
				    
				    success: function(data) {

				    	if(data=="") {
							$('#mensaje').html('Compruebe los datos ingresados');
						}else {

							$('#mensaje').html('Se agrego exitosamente');
			    			$('form#registrar').trigger("reset");
			    			$('#tablaPuertos').remove();
			    			
						}
				    },
				    
				    error: function(data) {
				        $('#mensaje').html('Error en el servidor');
				    },
				    
					    timeout:5000
				});
				

			}

			

		}





		function obtenerDatosDeTabla() {

			var puertos = [];
			var duraciones =[];


			for(var i=0;i<$('#tablaPuertos tr').length;i++){
				var valor = $('#fila'+i).val();
				if((i%2)==0) {
					puertos.push(valor);
				}else{
					duraciones.push(valor);
				}
			}

			return [puertos,duraciones];

		}




	</script>



</body>
</html>