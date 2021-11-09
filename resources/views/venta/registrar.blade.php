<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Venta</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.js') }}"></script>
</head>
<body>

	<div>

		<form id="registrar">

			<select id="itinerario" name="itinerario">
				
			</select>

			<br>
			<br>

			<input type="number" id="cantidad" name="cantidad" placeholder="Catidad">

			<br>
			<br>

			<input type="button" name="Consultar disponibilidad">

			<br>
			<br>

			<div id="desplegar"></div>

			<br>
			<br>

			<input type="button" name="Registrar Venta">
			

		</form>


	</div>

	<script>

		function cantidadDeClientes(){

		var cantidad = $("#cantidad").val();

		var campos = "";

			for (var i=0; i <=cantidad; i++) {

				campos+="<input type="text" id="cedula" name="cedula" placehorlder="Cedula">";
				campos+="<br><br>";
				campos+="<input type="text" id="nombre" name="nombre" placehorlder="Nombre">";
				campos+="<br><br>";
				campos+="<input type="text" id="apellido" name="apellido" placehorlder="Apellido">";
				campos+="<br><br>";
	

			}

			$('#desplegar').html(campos);

		}

		function optenerItinerario(){

			$.ajax({

				type: 'GET',

				url: "{{url('itinerario/listar')}}",

				success:function(data){
					verificarLargo(data);
				},

				error: function(data){
					$('#mensaje').html('Error en el servidor');
					$("#registrar : input").prop("disabled",true);
				},
				timeout:5000

			});



		}

		function verificarLargo(itinerario) {

			if(itinerario.length>0){
				desplegarItinerario(itinerario);
			}else{
				desactivarCampos();
			}
		
		}

		function desplegarItinerario(){

			$("#itinerario").html("");
			itinerario.forEach(function(elemento){
				$("#itinerario").append("<option value='"+elemento.id+"'>"elemento.fecha_hora_zarpado"</option>");

			});
		}

		function desactivarCampos(){
			$("#registrar :input").prop("disabled",true);
			$("#mensaje").html("No hay itinerarios dsiponibles");
		}

		function enviarPeticion(){

			$.ajax({

				type: 'POST',

				url: "{{url('venta/registrar')}}",

				data: $("#registrar").serialize(),

				success: function(data){
					if (data=="") {
						$('#mensaje').html('Compruebe los datos ingresados');
					}else{
						$('#mensaje').html('Se agrego exitosamente');
			    		$('form#registrar').trigger("reset");
					}
				},
				error: function(data){
					$('#mensaje').html('Error en el servidor');
				},

				timeout:5000


			});



		}

		function capturarDatosDelSistema(){
			
		}

		






	</script>

</body>
</html>