<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Reservar Pasajes</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>

	<!--<1:Itineario> <2:Cantidad Pasajes> <3F:Calcular Dispo> <4:Desplegar campos> <5:boton enviar> <6:Mensaje>-->
	<!--4 y 5 desactivados-->


	<div>

		<form id='registrar' action='#'>

			@csrf


			<select id='itineario' name='itineario'></select>

			
			<br>
			<br>


			<input type="number" min="1" id="cantidad">

			<br>
			<br>

			<div name='pasajeros'>

			</div>

			<br>
			<br>

			<input type="button" id='bot' value='Registrar Reserva'>



		</form>






	</div>



	<script>
		

		function obtenerItinerarios() {

			$.ajax({

				type: 'GET',

				url: "{{url('itinerario/listarconrutas')}}",

				success:function(data){
					
				},

				error: function(data){
					
				},
				timeout:5000

			});


		}


		function setEnabled(boole) {
			$('#cantidad').prop('disabled',boole);
			$('#bot').prop('disabled',boole);
		}

		function setEnabledAll(boole) {
			$('#itineario').prop('disabled',boole);
			$('#cantidad').prop('disabled',boole);
			$('#bot').prop('disabled',boole);
		}



	</script>



</body>
</html>