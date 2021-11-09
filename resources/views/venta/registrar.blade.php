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

			<input type="number" id="cantidad" name="cantidad" placeholder="Cantidad">

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

		optenerItinerario();

		function cantidadDeClientes(){

		var cantidad = $("#cantidad").val();

		var campos = "";

			for (var i=0; i <=cantidad; i++) {

				campos+="<input type='text' id='cedula"+i+"' name='cedula' placehorlder='Cedula'>";
				campos+="<br><br>";
				campos+="<input type='text' id='nombre"+i+"' name='nombre' placehorlder='Nombre'>";
				campos+="<br><br>";
				campos+="<input type='text' id='apellido"+i+"' name='apellido' placehorlder='Apellido'>";
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

		function desplegarItinerario(itinerario){

			$("#itinerario").html("");
			itinerario.forEach(function(elemento){
				$("#itinerario").append("<option value='"+elemento.id+"'>"+elemento.fecha_hora_zarpado+"</option>");

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
/**
		function realizarTransaccion(){

			var cantidad = $('#cantidad').val();

			DB::beginTransaction();

			try {

				for (var i=0; i <=cantidad; i++) {

					DB::insert("insert into clientes (cedula, nombre, apellido) values ($#cedula"+i+", $#nombre"+i+", $#apellido"+i+")");  
		
				}

    			DB::commit();
			} catch (\Exception $e) {
    			DB::rollback();
   				 throw $e;
			} catch (\Throwable $e) {
   				 DB::rollback();
   				 throw $e;
			}



		}

		**/






	</script>

</body>
</html>