<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Reservar Pasajes</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>



	<div>

		<form id='registrar' name='registrar' action='#'>

			@csrf


			Itinerario: <select id='itinerario' name='itinerario'></select>

			<br>
			<br>

			<label id='capacidad'></label>

			<br>
			<br>


			Cantidad Pasajes:<input type="number" name="cantidad" value="0" min="1" id="cantidad">

			<br>
			<br>

			Monto por pasajes:<input type="number" value="0" min="1" id="monto" name="monto">

			<br>
			<br>

			<div>
				<ul>
					<li>
						<label>Cliente:</label>
						<br>
						<br>
						Cedula:<input type="text" name="cedula">
						<br>
						<br>
						Nombre:<input type="text" name="nombre">
						<br>
						<br>
						Apellido:<input type="text" name="apellido">
					</li>
				</ul>
			</div>

			<br>
			<br>

			<input type="button" id='boton' onclick='ingresarPasajeros()' value='Ingresar Pasajeros'>

			<br>
			<br>

		
			<div id ='pasajeros' name='pasajeros'>
			

			</div>
			

			<br>
			<br>

			<input type="button" id='bot' onclick='registrarReserva()' value='Registrar Reserva'>

		</form>

		<br>
		<br>

		<label id='mensaje'></label>





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

				url: "{{url('reserva/pasajero')}}",
				    
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
					

					if(data!='') {

						itinerario=data;

						

						$('#itinerario').html('');
						mensajeCapacidad('Pasajes disponibles:'+data['capacidades'][0]);

						for(var i=0;i<data['mensajes'].length;i++) {
							$('#itinerario').append("<option value='"+data['ident'][i]+"'>"+data['mensajes'][i]+"</option>");
						}

						setDisabledAll(false);
						mensaje('');

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
			$('#boton').prop('disabled',boole);
			$('#cantidad').prop('disabled',boole);
			$('#bot').prop('disabled',boole);
		}

		function setDisabledAll(boole) {
			$('#itineario').prop('disabled',boole);
			$('#cantidad').prop('disabled',boole);
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

					mensajeCapacidad('Pasajes disponibles:'+itinerario['capacidades'][it]);
				}

			})

			
		}


		function desplegarFormularioPasajeros(cantidad){

			$('#pasajeros').html('');

			var formulario="<ul>";

			for(var i=0;i<cantidad;i++){
				formulario = formulario + formularioForma(i);
			}

			formulario = formulario + "</ul>";

			$('#pasajeros').html(formulario);

		}



	

		function formularioForma(parametro){


			var formulario="<li>"+
					"<label>Pasaje "+(parametro+1)+"</label>"+
					"<br><br>"+
					"Cedula:<input type='text' name='cedula_pasajero[]'>"+
					"<br><br>"+
					"Nombre:<input type='text' name='nombre_pasajero[]'>"+
					"<br><br>"+
					"Apellido:<input type='text' name='apellido_pasajero[]'><br><br>"+
				"</li>";

			return formulario;

		}


		function ingresarPasajeros() {

			mensaje('');
			$('#pasajeros').html('');

			var cantidad =$('#cantidad').val();

			if(selectedInd!=-1){

				if(cantidad>0){

					if(cantidad<=itinerario['capacidades'][selectedInd]){
						desplegarFormularioPasajeros(cantidad);
					}else{
						mensaje('No existen cupos para la cantidad indicada');
					}

				}else{
					mensaje('Ingrese una cantidad mayor a 0');
				}

			}

		}


	</script>



</body>
</html>