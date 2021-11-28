<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Venta de pasajes</title>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>



	<div>

		<form id='registrar' name='registrar' action='#'>

			@csrf

			<h2 class="title" >Venta de Pasajes</h2>
			Itinerario: <select id='itinerario' name='itinerario' class="select-content"></select>

			<br>
			<br>

			<label id='capacidad' class="labels"></label>

			<br>
			<br>


			<input type="number" name="cantidad" min="1" id="cantidad" placeholder="Cantidad" class="input">

			<br>
			<br>

			<input type="number" min="1" id="monto" name="monto" placeholder="Monto" class="input">

			<br>
			<br>

			<div>
				<ul>
					<li>
						<label class="labels">Cliente:</label>
						<br>
						<br>
						<input type="text" name="cedula" placeholder="Cedula" class="input">
						<br>
						<br>
						<input type="text" name="nombre" placeholder="Nombre" class="input">
						<br>
						<br>
						<input type="text" name="apellido" placeholder="Apellido" class="input">
					</li>
				</ul>
			</div>

			<br>
			<br>

			<input type="button" id='boton' onclick='ingresarPasajeros()' value='Ingresar Pasajeros' class="button">

			<br>
			<br>

		
			<div id ='pasajeros' name='pasajeros'>
			

			</div>
			

			<br>
			<br>

			<input type="button" id='bot' onclick='registrarReserva()' value='Registrar Venta' class="button">

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

				url: "{{url('venta/pasajero')}}",
				    
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


						if(data['pasaje']!='') {

						itinerario=data;

						

						$('#itinerario').html('');
						mensajeCapacidad('Pasajes disponibles:'+data['pasaje'][0]);

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

					mensajeCapacidad('Pasajes disponibles:'+itinerario['pasaje'][it]);
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

					if(cantidad<=itinerario['pasaje'][selectedInd]){
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