<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Manifiesto de Pasajeros</title>


	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >

	<style>

		table {
		  border-collapse: collapse;
		  
		}

		th, td {
		  text-align: left;
		  padding: 8px;
		}

		tr:nth-child(even){background-color: #f2f2f2}

		th {
		  background-color: #04AA6D;
		  color: white;
		}
	</style>


	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>



	<div>

		<div>


			Itinerario: <select id='itinerario' name='itinerario' class="select-content"></select>

			<br>
			<br>

			<label id='mensaje' class="labels"></label>

			<br>
			<br>

			<input type="button" class="button" onclick='generarManifiesto()' value="Generar manifiesto de cargas">

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


			mensaje('Obteniendo pasajeros...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('/manifiesto/pasajero')}}",
				data:{'id':$('#itinerario option').filter(':selected').val()},

				success:function(data){




					$('#tabla').html('')

					if(data!='') {


						if((data['reserva']!='') || (data['venta']!='')){


							var tabla ="<h3>Manifiesto:</h3><br><table><tr><th>Indice</th><th>cedula</th><th>nombre</th><th>apellido</th></tr>";


							for(var i=0;i<data['reserva'].length;i++){
									tabla = tabla + "<tr><td>"+(i+1)+"</td><td>"+data['reserva'][i]['cedula']+"</td><td>"+data['reserva'][i]['nombre']+"</td><td>"+data['reserva'][i]['apellido']+"</td></tr>";
							}


							for(var i=0;i<data['venta'].length;i++){
									tabla = tabla + "<tr><td>"+(i+1)+"</td><td>"+data['venta'][i]['cedula']+"</td><td>"+data['venta'][i]['nombre']+"</td><td>"+data['venta'][i]['apellido']+"</td></tr>";
							}


							tabla = tabla + "</table>";


							$('#tabla').html(tabla);



							


							mensaje('');

						}else{



							mensaje('No existe informacion');


						}


					}else{


						mensaje('No existe informacion');

					}


				},

				error: function(data){
					mensaje('Error en el servidor');
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