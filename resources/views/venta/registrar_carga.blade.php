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
			<h2 class="title" >Venta de espacios de carga</h2>

			Itinerario: <select id='itinerario' name='itinerario' class="select-content"></select>

			<br>
			<br>

			<label id='capacidad' class="labels"></label>

			<br>
			<br>

			<label id='mensaje' class="labels"></label>

			<br>
			<br>

			<label id='registromensaje' class="labels"></label>

			<br>
			<br>

			<label class="labels">Nota:Considere que en la venta solo se muestran aquellos itinerarios con fecha y hora de zarpado en la proxima hora o menos.</label>

			<br>
			<br>

			<div>

				<ul>

					<li>

						<label>Venta:</label>

						<br>
						<br>

						<input type="number"  min="1" id="monto" name="monto" class="input" placeholder="Monto por la carga">

					</li>

				</ul>

			</div>

			<br>
			<br>

			<div>
				<ul>
					<li>

						<label>Cliente:</label>
						<br>
						<br>
						
						<input type="text" id="cedula" name="cedula" class="input" placeholder="Cedula">
						
						<br>
						<br>
						
						<input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre">
						
						<br>
						<br>
						
						<input type="text" id="apellido" name="apellido" class="input" placeholder="Apellido">
					
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
						<input type="text" id='peso' name="peso" class="input" placeholder="Peso">
					</li>
				</ul>
			</div>
	
			<br>
			<br>

			<input type="button" id='bot' onclick='beforeAjax()' value='Vender' class="button"> 
		
			
			
		
		</form>

		

	</div>



	<script>

		obtenerItinerarios();
		cambioItinerario();



		function beforeAjax(){

			mensajeRegistro('');

			var monto =$('#monto').val();
			var peso =$('#peso').val();
	
			if($.isNumeric(monto) && $.isNumeric(peso)){

				if((monto<=0) || (peso<=0)){

					mensaje('El monto y peso de la carga debe ser mayor a 0');

				}else{

					registrarVenta();

				}

			}else{

				mensaje('Tanto el monto como el peso de la carga son numericos');
			
			}

		}

		


		function registrarVenta(){

			mensaje('Registrando venta...');
			

			$.ajax({

			    type: 'POST',

				url: "{{url('venta/carga')}}",
				    
				data: $("#registrar").serialize(),
				    
				success: function(data) {


					if(data!='') {

						if(data) {

							limpiarCampos();
							obtenerItinerarios();
							mensajeRegistro('Se agrego exitosamente');

						}else{

							mensaje('Verifique los datos ingresados')

						}

						
					}else{

						mensaje('Verifique los datos ingresados')

					}

				},

				    
				error: function(data) {
				
					mensaje("Error del servidor"); 		

				},

				timeout:5000

			});


		}


		function obtenerItinerarios() {

			mensaje('Obteniendo itinerarios...');

			$.ajax({

				type: 'GET',

				url: "{{url('itinerario/venta/carga')}}",

				success:function(data){
					

					if(data!=''){

						if(data['itinerarios'].length>0) {

							desplegarItinerario(data);
							
							mensaje('');
							mensajeCapacidad('Espacios de carga disponibles: '+data['itinerarios'][0]['capacidad']);

						}else{

							mensaje('No existen itinerarios');
							mensajeCapacidad('Espacios de carga disponibles: -----');


						}


					}else{
						
						mensaje('No existen itinerarios');
						mensajeCapacidad('Espacios de carga disponibles: -----');

					}


				},

				error: function(data){

					mensaje('Error de servidor');
					mensajeCapacidad('Pasajes disponibles: -----');					

				},

				timeout:5000

			});


		}




		function desplegarItinerario(data) {

			$("#itinerario").html("");

			for(var i=0;i<data['itinerarios'].length;i++) {

				var valores = data['itinerarios'][i];

				var ruta = valores['ruta'];

				var capacidad = valores['capacidad'];
				
				var itinerario = valores['itinerario'];

				var body = "<option id='option"+i+"' value='"+itinerario['id']+"' data-capacidad='"+capacidad+"'>";

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


	


		function cambioItinerario(){
			
		

			$('#itinerario').change(function(){

				limpiarCampos();

				var seleccion = $('#itinerario').prop('selectedIndex');

				if(seleccion>=0) {

					var capacidad = $("#option"+seleccion).data('capacidad');

					mensajeCapacidad('Espacios de carga disponibles:'+capacidad);

				}

			})
			
		}


		function limpiarCampos() {

			
			$("#monto").val(null);
			$("#cedula").val(null);
			$("#nombre").val(null);
			$("#apellido").val(null);

			$("#detalles").val(null);
			$("#peso").val(null);

		}


		function mensaje(mensaje){
			$('#mensaje').html(mensaje);
		}


		function mensajeRegistro(mensaje) {
			$("#registromensaje").html(mensaje);
		}


		function mensajeCapacidad(mensaje){
			$('#capacidad').html(mensaje);
		}


	</script>



</body>
</html>