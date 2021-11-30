<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Reserva de pasajes</title>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>



	<div>

		<form id='registrar' name='registrar' action='#' class="form-imputs">

			@csrf
			<h2 class="title" >Reservar Pasajes</h2>

			Itinerario: <select id='itinerario' name='itinerario' class="select-content"></select>

			<br>
			<br>

			<label id='capacidad' class="labels"></label>

			<br>
			<br>

			<label id='mensaje'></label>

			<br>
			<br>


			<div>

				<ul>

					<li>

						<label>Reserva:</label>
						
						<br>
						<br>

						<input type="number" name="cantidad"  min="1" id="cantidad" class="input" placeholder="Cantidad de pasajes">

						<br>
						<br>

						<input type="number"  min="1" id="monto" name="monto" class="input" placeholder="Monto por pasaje">

					</li>

				</ul>

			</div>

			<br>
			<br>

			<div>
				<ul>
					<li>

						<label>Cliente:</label>
						<br>
						<br>
						
						<input type="text" id="cedula" name="cedula" class="input" placeholder="Cedula">
						
						<br>
						<br>
						
						<input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre">
						
						<br>
						<br>
						
						<input type="text" id="apellido" name="apellido" class="input" placeholder="Apellido">
					
					</li>
				</ul>
			</div>

			<br>
			<br>

			<input type="button" id='boton' onclick='ingresar()' value='Ingresar Pasajeros' class="button">

			<br>
			<br>

		
			<div id ='pasajeros' name='pasajeros'>

			</div>
			

			<br>
			<br>

			<input type="button" id='bot' onclick='registrarReserva()' value='Reservar' class="button"> 
		
			
			
		
		</form>

		





	</div>



	<script>

		obtenerItinerarios();
		cambioItinerario();

		
		function registrarReserva(){


			$.ajax({

			    type: 'POST',

				url: "{{url('reserva/pasajero')}}",
				    
				data: $("#registrar").serialize(),
				    
				success: function(data) {

					if(data='') {

						mensaje("Verifique los datos ingresados...");

					}else{

						limpiarCampos();
						obtenerItinerarios();
						mensaje("Se agrego exitosamente");

					}

				},
				    
				error: function(data) {
				
					mensaje("Error del servidor"); 		

				},

				timeout:5000

			});


		}


		function obtenerItinerarios() {

			mensaje('Obteniendo itinerarios...');

			$.ajax({

				type: 'GET',

				url: "{{url('itinerario/reserva/pasaje')}}",

				success:function(data){
					

					if(data!=''){

						if(data['itinerarios'].length>0) {

							desplegarItinerario(data);
							
							mensaje('');
							mensajeCapacidad('Pasajes disponibles: '+data['itinerarios'][0]['capacidad']);

						}else{

							mensaje('No existen itinerarios');
							mensajeCapacidad('Pasajes disponibles: -----');


						}


					}else{
						
						mensaje('No existen itinerarios');
						mensajeCapacidad('Pasajes disponibles: -----');

					}


				},

				error: function(data){

					mensaje('Error de servidor');
					mensajeCapacidad('Pasajes disponibles: -----');					

				},

				timeout:5000

			});


		}




		function desplegarItinerario(data) {

			$("#itinerario").html("");

			for(var i=0;i<data['itinerarios'].length;i++) {

				var valores = data['itinerarios'][i];

				var ruta = valores['ruta'];

				var capacidad = valores['capacidad'];
				
				var itinerario = valores['itinerario'];

				var body = "<option id='option"+i+"' value='"+itinerario['id']+"' data-capacidad='"+capacidad+"'>";

					body = body +mensajeDeItinerario(itinerario,ruta);

					body = body + "</option>"

				$("#itinerario").append(body);

			}



		}



		function mensajeDeItinerario(itinerario,ruta) {

			var mensajeItineario = itinerario.fecha_hora_zarpado+"\t/\t";

			var puertos = JSON.parse(ruta.puertos_intermedios);
			var duracion = JSON.parse(ruta.duracion_recorridos);
			
			for(var i= 0;i<puertos.length;i++) {
							
				if(i<=(duracion.length-1)){
									
					mensajeItineario = mensajeItineario + (puertos[i]+" > "+duracion[i]+" mins > ");
				
				}else{

					mensajeItineario = mensajeItineario + puertos[i];
				
				}

			}

			return mensajeItineario;

		}


	


		function cambioItinerario(){
			
		

			$('#itinerario').change(function(){

				limpiarCampos();

				var seleccion = $('#itinerario').prop('selectedIndex');

				if(seleccion>=0) {

					var capacidad = $("#option"+seleccion).data('capacidad');

					mensajeCapacidad('Pasajes disponibles:'+capacidad);

				}

			})
			
		}


		function ingresar() {

			mensaje('');
			$('#pasajeros').html('');

			var seleccion = $('#itinerario').prop('selectedIndex');
			var capacidad = $("#option"+seleccion).data('capacidad');
			var cantidad =$('#cantidad').val();

	
			if(cantidad>0){

				if(cantidad<=capacidad){

					desplegarFormulario(cantidad);
			
				}else{
			
					mensaje('No existen cupos para la cantidad indicada');
			
				}

			}else{

				mensaje('Ingrese una cantidad mayor a 0');
			
			}

			

		}


		function desplegarFormulario(cantidad){


			var formulario="<ul>";

			for(var i=0;i<cantidad;i++){
				

				var body="<li>"+
							"<label>Pasaje "+(i+1)+"</label>"+
							"<br><br>"+
							"Cedula:<input type='text' class='input' placeholder='Cedula' name='cedula_pasajero[]'>"+
							"<br><br>"+
							"Nombre:<input type='text' class='input' placeholder='Nombre' name='nombre_pasajero[]'>"+
							"<br><br>"+
							"Apellido:<input type='text' class='input' placeholder='Apellido' name='apellido_pasajero[]'><br><br>"+
						"</li>";

				formulario = formulario + body;


			}

			formulario = formulario + "</ul>";

			$('#pasajeros').html(formulario);

		}


		function limpiarCampos() {

			$("#pasajeros").html("");
			$("#cantidad").val(null);
			$("#monto").val(null);
			$("#cedula").val(null);
			$("#nombre").val(null);
			$("#apellido").val(null);

		}


		function mensaje(mensaje){
			$('#mensaje').html(mensaje);
		}


		function mensajeCapacidad(mensaje){
			$('#capacidad').html(mensaje);
		}


	</script>



</body>
</html>