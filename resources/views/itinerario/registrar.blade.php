<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Itinerario</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.js') }}"></script>
</head>
<body>

	<div>
		<form id="registrar">
			
			@csrf

			
				Fecha de zarpado:<input type="datetime-local" id="fecha" name="fecha_hora_zarpado" placeholder="Fecha de zarpado">

				<br>
				<br>

				Ruta:<select id="ruta" name="ruta">
				
				</select>

				<br>
				<br>

				Nave:<select id="nave" name="nave">
				
				</select>

				<br>
				<br>

				<input type="button"  id="bot" value ="Registrar Itinerario" onclick="enviarPeticion()">
		</form>

		<br>
		<br>
		
		<label id="mensaje"></label>



	</div>

	<script>

		$("#bot").prop("disabled",true);
		$("#nave").prop("disabled",true);
		
		obtenerRutas();

		$('#fecha').change(function(){
			consultarDisponibilidad();
		});



		function obtenerRutas() {


			$.ajax({

			    type: 'GET',

				url: "{{url('ruta/listar')}}",
				    
				success: function(data) {

					if(data.length>0){


						$("#ruta").html("");


						data.forEach(function(elemento){

							var option = "<option value='"+elemento.id+"'>";

							var current = JSON.parse(elemento.puertos_intermedios);
							var duracion = JSON.parse(elemento.duracion_recorridos);

							for(var i= 0;i<current.length;i++) {
							
								if(i<=(duracion.length-1)){
									
									option = option.concat(current[i]+" > "+duracion[i]+" mins > ");
								}else{
									option = option.concat(current[i]);
								}


							}

							option = option.concat("</option>");

							$("#ruta").append(option);
							

						});

					}else{

					
						
						$("#mensaje").html("No existen rutas.");

					}

				},
				    
				error: function(data) {
				    $('#mensaje').html('Error en elservidor');
			
				},

				timeout:5000

			});
	
		}



		function consultarDisponibilidad(){

			$.ajax({

			    type: 'POST',

				url: "{{url('nave/disponibilidad')}}",

				data:{
					'fecha':$("#fecha").val(),
					"_token": "{{ csrf_token() }}"
				},
				    
				success: function(data) {
					
					

					if(data.length>0){


						$("#nave").html("");

						data.forEach(function(elemento){
							$("#nave").append("<option value='"+elemento.id+"'>"+elemento.nombre+"</option>");
						});

						$("#bot").prop("disabled",false);
						$("#nave").prop("disabled",false);

					}else{

						

						$("#fecha").prop("disabled",false);
						$("#ruta").prop("disabled",false);
						
						$("#mensaje").html("No existen naves disponibles en la fecha indicada.");
						
					}
				
				},
				    
				error: function(data) {
				    $('#mensaje').html('Error en elservidor');
				 
				},

				timeout:5000

			});

		}




		function enviarPeticion() {
			
			$.ajax({

			    type: 'POST',

				url: "{{url('itinerario/registrar')}}",
				    
				data: $("#registrar").serialize(),
				    
				success: function(data) {

						if(data=="") {
							$('#mensaje').html('Compruebe los datos ingresados');
						}else {

							$('#mensaje').html('Se agrego exitosamente');


			    			$('#nave').trigger("reset");
			    			$('#fecha').trigger("reset");
			    			$("#bot").prop("disabled",true);
			    			$("#bot").prop("disabled",true);
			    			
			    			
			    			
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