<!DOCTYPE html>
<html>
<head>

	<script src="{{ asset('js/jquery.js') }}"></script>

	
</head>
<body>


	<div>

		<div>

			Nave: <select id='nave' name='nave'></select>

			<br>
			<br>

			<label id='mensaje'>				
			</label>

			<br>
			<br>

			<input type="button" id="bot" onclick='obtenerInforme()' value="Generar Informe">

			<br>
			<br>
			


		</div>



		<div id="tabla_informe">


		</div>



	</div>




	<script type="text/javascript">

		obtenerNaves();
		

		function obtenerNaves() {



			mensaje('Obteniendo naves...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('nave/listar')}}",
 
				success: function(data) {
					
					

					if(data.length>0){


						$("#nave").html("");

						data.forEach(function(elemento){
							$("#nave").append("<option value='"+elemento.id+"'>"+elemento.nombre+"</option>");
						});

						$("#bot").prop("disabled",false);
						$("#nave").prop("disabled",false);


						mensaje('');


					}else{
						
						$("#bot").prop("disabled",true);
						$("#nave").prop("disabled",true);

						mensaje("No existen naves disponibles.");
						
					}
				
				},
				    
				error: function(data) {

				    mensaje('Error en elservidor');
				 
				},

				timeout:5000

			

			});


		}




		function obtenerInforme() {



			mensaje('Obteniendo informe...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('informe/informe_nave')}}",

				data:{'id':$('#nave option').filter(':selected').val()},
 
				success: function(data) {
					
					$("#tabla_informe").html(data);

					if(data!=''){

						if(data['informe'].length>1) {

							mensaje("");

							$("#tabla_informe").html("");

							var deploy = "";

							for(var i=0;i<data['informe'].length;i++) {

								

								deploy = deploy + itinerarioYRuta(data['informe'][i]['itinerario'],data['informe'][i]['ruta'],i);


							}


							$("#tabla_informe").html(deploy);


						}else{

							mensaje("No existen informacion.");

						}



					}else{
						

						mensaje("No existen informacion.");
						
					}
				
				},
				    
				error: function(data) {

				    mensaje('Error en elservidor');
				 
				},

				timeout:5000

			

			});



		}

		function itinerarioYRuta(informe,ruta,num) {

			var mensaje = "<hr><div><ul>";

			var r = obtenerRuta(ruta);
			var p = JSON.parse(ruta['puertos_intermedios']);

			var intermedios = "";

			for(var i=0;i<p.length;i++) {
				intermedios = intermedios + p[i]+"|";
			}


			mensaje = mensaje + "<li>Itinerario "+(num+1)+"</li>";
			
			mensaje = mensaje + "<li>Fecha y hora de zarpado: "+informe["fecha_hora_zarpado"]+"</li>";

			mensaje = mensaje + "<li>Fecha y hora de Registro: "+informe["created_at"]+"</li>";

			mensaje = mensaje + "<li>Ruta relacionada:<ul>";

			mensaje = mensaje + "<li>Puerto de inicio: "+p[0]+"</li>";

			mensaje = mensaje + "<li>Puerto destino: "+p[p.length-1]+"</li>";

			mensaje = mensaje + "<li>Puertos: "+intermedios+"</li>";

			mensaje = mensaje + "<li>Recorrido: "+r+"</li>";

			mensaje = mensaje + "</ul></li></ul></div>";

			return mensaje;

		}


		function obtenerRuta(data){

			var mensaje = "";

			var puertos = JSON.parse(data['puertos_intermedios']);
			var duraciones = JSON.parse(data['duracion_recorridos']);

			for(var i=0;i<puertos.length;i++){

				mensaje = mensaje + "  "+puertos[i];


				if(i<=(duraciones.length-1)){
					mensaje = mensaje + "  >"+duraciones[i]+" mins>"
				}

			}

			return mensaje;

		}



		function obtenerMensajeItinerario(data){

		}


		function mensaje(mensaje){
		
			$('#mensaje').html(mensaje);
		
		}

	</script>


</body>
</html>