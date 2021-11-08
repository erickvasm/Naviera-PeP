<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Itinerario</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.js') }}"></script>
</head>
<body>

	<div>
		<form id="registrar" action="#">
			
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

			<input type="submit" name="registrar">


		</form>

		<br>
		<br>
		
		<label id="mensaje"></label>



	</div>

	<script>
		
		obtenerRutas();
		obtenerNaves();

		$('#fecha').change(function(){
			consultarDisponibilidad();
		});

		$.extend( $.validator.messages, {
			required: "Este campo es requerido.",
			remote: "Por favor, llene este campo.",
			email: "Por favor, escriba una dirección de correo válida.",
			url: "Por favor, escriba una URL válida.",
			date: "Por favor, escriba una fecha válida.",
			dateISO: "Por favor, escriba una fecha (ISO) válida.",
			number: "Por favor, escriba un número válido.",
			digits: "Por favor, escriba sólo dígitos.",
			creditcard: "Por favor, escriba un número de tarjeta válido.",
			equalTo: "Por favor, escriba el mismo valor de nuevo.",
			extension: "Por favor, escriba un valor con una extensión aceptada.",
			maxlength: $.validator.format( "Por favor, no escriba más de {0} caracteres." ),
			minlength: $.validator.format( "Por favor, no escriba menos de {0} caracteres." ),
			rangelength: $.validator.format( "Por favor, escriba un valor entre {0} y {1} caracteres." ),
			range: $.validator.format( "Por favor, escriba un valor entre {0} y {1}." ),
			max: $.validator.format( "Por favor, escriba un valor menor o igual a {0}." ),
			min: $.validator.format( "Por favor, escriba un valor mayor o igual a {0}." ),
			cedCR: "Por favor, escriba el número de cédula válido."
			} );

		function obtenerRutas() {

			$.ajax({

			    type: 'GET',

				url: "{{url('ruta/listar')}}",
				    
				success: function(data) {

					if(data.length>0){


						$("#ruta").html("");


						data.forEach(function(elemento){

							var option = "<option id='"+elemento.id+"'>";

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

						$("#registrar :input").prop("disabled",true);
						$("#mensaje").html("No existen rutas.");

					}
				
				},
				    
				error: function(data) {
				    $('#mensaje').html('Error en elservidor');
				    $("#registrar :input").prop("disabled",true);
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

					}else{

						$("#registrar :input").prop("disabled",true);
						$("#fecha").prop("disabled",false);
						$("#mensaje").html("No existen naves disponibles en la fecha indicada.");

					}
				
				},
				    
				error: function(data) {
				    $('#mensaje').html('Error en elservidor');
				    $("#registrar :input").prop("disabled",true);
				},

				timeout:5000

			});

		}


		function obtenerNaves() {

			$.ajax({

			    type: 'GET',

				url: "{{url('nave/listar')}}",
				    
				success: function(data) {

					if(data.length>0){


						$("#nave").html("");

						data.forEach(function(elemento){
							$("#nave").append("<option value='"+elemento.id+"'>"+elemento.nombre+"</option>");
						});

					}else{

						$("#registrar :input").prop("disabled",true);
						$("#mensaje").html("No existen naves.");

					}
				
				},
				    
				error: function(data) {
				    $('#mensaje').html('Error en elservidor');
				    $("#registrar :input").prop("disabled",true);
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
			    			$('form#registrar').trigger("reset");
			    			
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