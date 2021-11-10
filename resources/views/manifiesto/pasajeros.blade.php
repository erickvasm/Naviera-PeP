<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Manifiesto de Carga</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>



	<div>

		<div>


			Itinerario: <select id='itinerario' name='itinerario'></select>

			<br>
			<br>

			<label id='mensaje'></label>

			<br>
			<br>

			<input type="button" onclick='generarManifiesto()' value="Generar manifiesto de cargas">

			<br>
			<br>

			<table id='tabla'>
				
			</table>
	
		</div>


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

				url: "{{url('itinerario/listarconrutasventas')}}",

				success:function(data){
					

					if(data!=''){


						if(data['carga']!='') {

						itinerario=data;

						

						$('#itinerario').html('');
						mensajeCapacidad('Pasajes disponibles:'+data['carga'][0]);

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