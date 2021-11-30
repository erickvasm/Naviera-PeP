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

				url: "{{url('itinerario/obtener_itinerarios')}}",

				success:function(data){

					if(data!=''){

						if(data['itinerarios'].length>0) {

							desplegarItinerario(data);
							mensaje('');

						}else{

							mensaje('No existen itinerarios');

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






		function desplegarItinerario(data) {

			$("#itinerario").html("");

			for(var i=0;i<data['itinerarios'].length;i++) {

				var valores = data['itinerarios'][i];

				var ruta = valores['ruta'];
				
				var itinerario = valores['itinerario'];

				var body = "<option value='"+itinerario['id']+"'>";

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






		function generarManifiesto() {


			mensaje('Obteniendo cargas...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('/manifiesto/carga')}}",
				data:{'id':$('#itinerario option').filter(':selected').val()},

				success:function(data){
					
					$('#tabla').html('')

					var tabla ="<tr><th>Indice</th><th>Peso</th><th>Detalles</th></tr>";


					for(var i=0;i<data['reserva'].length;i++){

							tabla = tabla + "<tr><td>"+(i+1)+"</td><td>"+data['reserva'][i]['peso']+"</td><td>"+data['reserva'][i]['detalle']+"</td></tr>";
					
					}


					for(var i=0;i<data['venta'].length;i++){

							tabla = tabla + "<tr><td>"+(i+1)+"</td><td>"+data['venta'][i]['peso']+"</td><td>"+data['venta'][i]['detalle']+"</td></tr>";

					}


					tabla = tabla + "</table>";


					$('#tabla').html(tabla);


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