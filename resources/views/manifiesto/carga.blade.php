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

		obtenerItinerarios();


		function obtenerItinerarios() {


			mensaje('Obteniendo itinerarios...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('itinerario/listar')}}",

				success:function(data){
					if(data!=''){

						if(data['mensajes']!='') {


							for(var i=0;i<data['mensajes'].length;i++) {
								$('#itinerario').append("<option value='"+data['ident'][i]+"'>"+data['mensajes'][i]+"</option>");
							}


							mensaje('');


						}


					}else{
						mensaje('No existen itinerarios');
					}
				},

				error: function(data){
					mensaje('Error en el servidor')
				},
				timeout:5000

			});


		}




		function generarManifiesto() {


			mensaje('Obteniendo cargas...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('/manifiesto/carga')}}",
				data:{'id':$('#itinerario option').filter(':selected').val()},

				success:function(data){
					
					console.log(data);


					mensaje('');
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




	</script>



</body>
</html>