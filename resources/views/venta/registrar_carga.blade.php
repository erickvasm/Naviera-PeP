<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Venta de espacios de carga</title>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>



	<div>

		<form id='registrar' name='registrar' action='#' class="form-imputs">

			@csrf

			<h2 class="title" >Venta de Carga</h2>
			Itinerario: <select id='itinerario' name='itinerario' class="select-content"></select>

			<br>
			<br>

			<label id='capacidad' class="labels"></label>

			<br>
			<br>


			<input type="number" min="1" id="monto" name="monto" placeholder="Monto" class="input">


			<div>
				<ul>
					<li>
						<label class="labels">Cliente:</label>
						<br>
						<br>
						<input type="text" id='cedula' name="cedula" placeholder="Cedula" class="input">
						<br>
						<br>
						<input type="text" id='nombre' name="nombre" placeholder="Nombre" class="input">
						<br>
						<br>
						<input type="text" id='apellido' name="apellido" placeholder="Apellido" class="input">
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
						<input type="number" id='peso' name="peso" class="input" placeholder="Peso">
					</li>
				</ul>
			</div>
	

			<br>
			<br>

			<input type="button" id='bot' onclick='registrarVentas()' value='Registrar Venta' class="button">
			
			<br>
			<br>

			<label id='mensaje'></label>
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

		
		function registrarVenta(){

			mensaje('');

			$.ajax({

			    type: 'POST',

				url: "{{url('venta/carga')}}",
				    
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

				url: "{{url('itinerario/listarconrutasventas')}}",

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