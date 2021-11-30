<!DOCTYPE html>
<html>
<head>
	
	<script src="{{ asset('js/jquery.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/class.css') }}" >

</head>
<body>

	<form id="registrar" action="#" class="form-imputs">
			
		@csrf
		<h2 class="title" >Cierre de caja</h2>

		<div>

			<br>
			<br>


			<input type="button" class="button" onclick="obtenerCierreDeCaja()" value="Obtener Cierre de Caja"/>

			<br><br>

			<label id="mensaje"></label>


			<br><br>

			<div id="cierre_caja">

			</div>


		</div>
    </form>

	<script type="text/javascript">
		


		function obtenerCierreDeCaja() {



			$.ajax({

				type: 'GET',

				url: "{{url('contabilidad/cierre_caja')}}",
 
				success: function(data) {


					desplegar(data);

					mensaje('');
				
				},
				    
				error: function(data) {

				    mensaje('Error en elservidor');
				 
				},

				timeout:5000

			

			});

		}



		function desplegar(data) {

			$("#cierre_caja").html("");

			var body = "<ul>";

				body = body + "<h1>Cierre de caja para el dia de hoy:</h1>";

				body = body + "<h3>Cantidades:</h3>";

				body = body + "<li>Cantidad de Pasajes: "+data['cantidadPasajes']+"</li>";

				body = body + "<li>Cantidad de Espacios de Cargas: "+data['cantidadCargas']+"</li>";

				body = body + "<li>Cantidad de Reservas: "+data['cantidadReservas']+"</li>";

				body = body + "<li>Cantidad de Ventas: "+data['cantidadVentas']+"</li>";

				body = body + "<h3>Montos:</h3>";

				body = body + "<li>Por pasajes: "+data['montoPasajes']+"</li>";

				body = body + "<li>Por espacios de cargas: "+data['montoPasajes']+"</li>";

				body = body + "<li>Por reservas: "+data['montoReservas']+"</li>";

				body = body + "<li>Por ventas: "+data['montoVentas']+"</li>";

				body = body + "<h3>Total:</h3>";

				body = body + "<li>Total diaro: "+(data['montoVentas']+data['montoReservas'])+"</li>";				

			body = body + "</ul>";

			$("#cierre_caja").html(body);

		}


		function mensaje(mensaje){
		
			$('#mensaje').html(mensaje);
		
		}



	</script>




</body>
</html>
