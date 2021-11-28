<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Reserva de carga</title>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>



	<div>

		<form id='registrar' name='registrar' action='#' class="form-imputs">

			@csrf
			<h2 class="title" >Reservar Carga</h2>

			Itinerario: <select id='itinerario' name='itinerario' class="select-content"></select>

			<br>
			<br>

			<label id='capacidad' class="labels"></label>

			<br>
			<br>


			<input type="number" value="0" min="1" id="monto" name="monto" class="input">


			<div>
				<ul>
					<li>
						<label class="labels">Cliente:</label>
						<br>
						<br>
						<input type="text" id='cedula' name="cedula" class="input" placeholder="Cedula">
						<br>
						<br>
						<input type="text" id='nombre' name="nombre" class="input" placeholder="Nombre">
						<br>
						<br>
						<input type="text" id='apellido' name="apellido" class="input" placeholder="Apellido">
					</li>
				</ul>
			</div>

			<br>
			<br>


			<div>
				<ul>
					<li>
						<label class="labels">Carga:</label>
						<br>
						<br>
						<input type="text" id='detalles' name="detalles" class="input" placeholder="Detalles">
						<br>
						<br>
						<input type="text" id='peso' name="peso" class="input" placeholder="Peso">
					</li>
				</ul>
			</div>
	

			<br>
			<br>

			<input type="button" id='bot' onclick='registrarReserva()' value='Reservar' class="button">

			<br>
			<br>

			<label id='mensaje' class="labels"></label>

		</form>

		





	</div>



	<script>

		let itinerario;
		itinerario;

		let selectedInd;
		selectedInd=0;

		setDisabledAll(true);
		obtenerItinerarios();
		cambioItinerario();

		
		function registrarReserva(){

			mensaje('');

			$.ajax({

			    type: 'POST',

				url: "{{url('reserva/carga')}}",
				    
				data: $("#registrar").serialize(),
				    
				success: function(data) {

						if(data=="") {

							mensaje('Compruebe los datos ingresados');


						}else {


							mensaje('Se agrego exitosamente');
							$('#pasajeros').html("");
		    			
						}

					},
				    
				   error: function(data) {
				   		mensaje('Error en el servidor');
				   },

				   timeout:5000

			});


		}




		function obtenerItinerarios() {


			mensaje('Obteniendo itinerarios...');
			mensajeCapacidad('');

			$.ajax({

				type: 'GET',

				url: "{{url('itinerario/listarconrutas')}}",

				success:function(data){
					

					if(data!=''){


						if(data['carga']!='') {

						itinerario=data;

						

						$('#itinerario').html('');
						mensajeCapacidad('Espacios disponibles:'+data['carga'][0]);

						for(var i=0;i<data['mensajes'].length;i++) {
							$('#itinerario').append("<option value='"+data['ident'][i]+"'>"+data['mensajes'][i]+"</option>");
						}

						setDisabledAll(false);
						mensaje('');

						}else{
							mensaje('No existen itinearios');
							setDisabledAll(true);
						}


					}else{
						mensaje('No existen itinearios');
						setDisabledAll(true);
					}


				},

				error: function(data){
					mensaje('Error en el servidor')
				},
				timeout:5000

			});


		}

		function mensaje(mensaje){
			$('#mensaje').html(mensaje);
		}


		function setDisabled(boole) {
			$('#cedula').prop('disabled',boole);
			$('#nombre').prop('disabled',boole);
			$('#apellido').prop('disabled',boole);
			$('#monto').prop('disabled',boole);
			$('#detalles').prop('disabled',boole);
			$('#peso').prop('disabled',boole);
			$('#bot').prop('disabled',boole);
		}

		function setDisabledAll(boole) {
			$('#itineario').prop('disabled',boole);
			$('#cedula').prop('disabled',boole);
			$('#nombre').prop('disabled',boole);
			$('#apellido').prop('disabled',boole);
			$('#monto').prop('disabled',boole);
			$('#detalles').prop('disabled',boole);
			$('#peso').prop('disabled',boole);
			$('#bot').prop('disabled',boole);
		}


		function mensajeCapacidad(mensaje){
			$('#capacidad').html(mensaje);
		}


		function cambioItinerario(){

			$('#itinerario').change(function(){

				var it = $('#itinerario').prop('selectedIndex');

				if(it>=0) {

					selectedInd=it;

					mensajeCapacidad('Pasajes disponibles:'+itinerario['carga'][it]);
				}

			})

			
		}





	</script>



</body>
</html>