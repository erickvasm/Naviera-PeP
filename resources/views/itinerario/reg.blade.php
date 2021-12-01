<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Itinerario</title>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.js') }}"></script>
</head>
<body>

	<div>
		<form id="registrar" class="form-imputs">
			
			@csrf
			<h2 class="title" >Registro de itinerarios</h2>
			
				<input type="datetime-local" id="fecha" name="fecha_hora_zarpado" placeholder="Fecha de zarpado" class="input">

				<br>
				<br>

				Ruta:<select id="ruta" name="ruta" class="select-content">
				
				</select>

				<br>
				<br>

				<input type="button"  id="botCont" value ="Consultar Disponibilidad" onclick="consultarDisponibilidad()" class="button" class="button">

				<br>
				<br>
		

				Nave:<select id="nave" name="nave" class="select-content">
				
				</select>

				<br>
				<br>

				<input type="button"  id="bot" value ="Registrar Itinerario" onclick="beforeAjax()" class="button" class="button">

				<br>
				<br>
		
				<label id="mensaje" class="labels"></label>


				<br>
				<br>

				<label id='registromensaje' class="labels"></label>


		</form>

		



	</div>

	<script>

		obtenerRutas();
		detectarCambios();



		function beforeAjax(){

			mensajeRegistro('');

			var nave = $("#nave").val();
	
			if((nave==null) || (nave=="")){


				mensaje('Consulte la disponibilidad');

				
			}else{

				enviarPeticion();			
			
			}

		}




		function obtenerRutas() {

			mensaje('Obteniendo rutas...');

			$.ajax({

			    type: 'GET',

				url: "{{url('ruta/listar')}}",
				    
				success: function(data) {

					if(data!='') {

						if(data.length>0){

							mensajeRuta(data);
							mensaje('');

						}else{

							mensaje('No existen rutas');
							desactivarBoton(true);

						}

					}else{

						mensaje('No existen rutas');
						desactivarBoton(true);

					}

				},
				    
				error: function(data) {
				   
				   mensaje('Error del servidor');
				   desactivarBoton(true);
			
				},

				timeout:5000

			});
	
		}


		function mensajeRuta(data) {

			$("#ruta").html("");

			for(var c=0;c<data.length;c++) {

				var current = JSON.parse(data[c].puertos_intermedios);
				var duracion = JSON.parse(data[c].duracion_recorridos);

				var option = "<option value='"+(data[c].id)+"'>";

				for(var i= 0;i<current.length;i++) {
							
					if(i<=(duracion.length-1)){
									
						option = option + (current[i]+" > "+duracion[i]+" mins > ");
				
					}else{

						option = option + (current[i]);
				
					}


				}

				option = option + "</option>";

				$("#ruta").append(option);

			}
			


		}



		function mensajeNave(data) {

			$("#nave").html("");

			for(var c=0;c<data.length;c++) {

				$("#nave").append("<option value='"+data[c].id+"'>"+data[c].nombre+"</option>");

			}
			


		}




		function detectarCambios() {

			$('#fecha').change(function(){
				limpiarCampoNave();
			});

			$('#ruta').change(function(){
				limpiarCampoNave();
			});


		}



		function limpiarCampos() {

			$("#ruta").html("");
			$("fecha").val(null);
			limpiarCampoNave();

		}


		function limpiarCampoNave() {

			$("#nave").html("");

		}



		function consultarDisponibilidad(){

			mensaje('Consultando disponibilidad de naves');

			var ruta = $("#ruta").val();

			if((ruta==null) || (ruta=='')){

				mensaje('No existen ruta');

			}else{



				$.ajax({

				    type: 'POST',

					url: "{{url('nave/disponibilidad')}}",

					data:{
						'fecha':$("#fecha").val(),
						"_token": "{{ csrf_token() }}",
						'ruta':$("#ruta").val()
					},
					    
					success: function(data) {
						

						if(data!=''){

							mensajeNave(data);
							mensaje('');

						}else{

							mensaje('No existen naves disponibles para la fecha y ruta especificada');

						}
					
					},
					    
					error: function(data) {
						
						mensaje('Error del servidor');    
					 
					},

					timeout:5000

				});




			}


			
		}




		function enviarPeticion() {

			mensaje('Registrando itinerario...');
			
			$.ajax({

			    type: 'POST',

				url: "{{url('itinerario/registrar')}}",
				    
				data: $("#registrar").serialize(),
				    
				success: function(data) {


					if(data!="") {
							
						mensaje('Error al registrar');
					
					}else {

						mensaje('');
						limpiarCampos();
						mensajeRegistro('Se agrego exitosamente');
			    			
			    	}

						
				},
				    
				error: function(data) {
				      	
				    mensaje('Error del servidor');

				},

				timeout:5000

			});

				
		}


		function mensaje(mensaje) {

			$("#mensaje").html(mensaje);

		}


		function desactivarBoton(desactivar){

			$("#botCont").prop("disabled",desactivar);
			$("#bot").prop("disabled",desactivar);

		}

		function mensajeRegistro(mensaje) {
			$("#registromensaje").html(mensaje);
		}




	</script>








</body>
</html>