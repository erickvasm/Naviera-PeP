<!DOCTYPE html>
<html>
<head>

	<script src="{{ asset('js/jquery.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	
</head>
<body>


		<form id="registrar" action="#" class="form-imputs">
			
			@csrf
			<h2 class="title" >Informes Ruta</h2>
			
			<div>

			<div>

				Ruta: <select id='ruta' name='ruta' class="select-content"></select>

				<br>
				<br>

				<label id='mensaje'>				
				</label>

				<br>
				<br>

				<input type="button" id="bot" class="button" onclick='obtenerInforme()' value="Generar Informe">

				<br>
				<br>
			
		</div>



		<div id="tabla_informe">


		</div>



		</div>

		</form>


	<script type="text/javascript">

		obtenerRuta();
		

		function obtenerRuta() {



			mensaje('Obteniendo rutas...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('ruta/listar')}}",
 
				success: function(data) {
					
					

					if(data.length>0){


						$("#ruta").html("");

						data.forEach(function(elemento){
							
							$("#ruta").append("<option value='"+elemento.id+"'>"+obtenerNombreRuta(elemento)+"</option>");
						});

						$("#bot").prop("disabled",false);
						$("#ruta").prop("disabled",false);


						mensaje('');


					}else{
						
						$("#bot").prop("disabled",true);
						$("#ruta").prop("disabled",true);

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

				url: "{{url('informe/informe_ruta')}}",

				data:{'id':$('#ruta option').filter(':selected').val()},
 
				success: function(data) {
					
					$("#tabla_informe").html(data);

					if(data!=''){

						if(data['informe'].length>0) {

							mensaje("");

							$("#tabla_informe").html("");

							var deploy = "";

							for(var i=0;i<data['informe'].length;i++) {

								

								deploy = deploy + itinerarioYNave(data['informe'][i]['itinerario'],data['informe'][i]['nave'],i);


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

		function itinerarioYNave(informe,nave,num) {

			var mensaje = "<hr><div><ul>";


			mensaje = mensaje + "<li>Itinerario "+(num+1)+"</li>";
			
			mensaje = mensaje + "<li>Fecha y hora de zarpado: "+informe["fecha_hora_zarpado"]+"</li>";

			mensaje = mensaje + "<li>Fecha y hora de Registro: "+informe["created_at"]+"</li>";

			mensaje = mensaje + "<li>Nave relacionada:<ul>";

			mensaje = mensaje + "<li>Nombre: "+nave['nombre']+"</li>";

			mensaje = mensaje + "<li>Capacidad pasajeros: "+nave['capacidad_pasajeros']+"</li>";

			mensaje = mensaje + "<li>Capacidad carga: "+nave['capacidad_carga']+"</li>";

			mensaje = mensaje + "</ul></li></ul></div>";

			return mensaje;

		}


		function obtenerNombreRuta(data){

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


		function mensaje(mensaje){
		
			$('#mensaje').html(mensaje);
		
		}

	</script>


</body>
</html>
