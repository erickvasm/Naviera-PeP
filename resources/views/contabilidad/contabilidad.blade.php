<!DOCTYPE html>
<html>
<head>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script src="{{ asset('js/jquery.js') }}"></script>


</head>
<body>

	<div>

		<br><br>
		
		<label id="mensaje"></label>


		<br><br>

		<div>


			<table style="border: solid 1px gray;border-bottom: 0px;border-right: 0px;">


				<tr>

					<td style="border-right: 2px dotted;border-bottom: 2px dotted;">

						<div>

							<canvas id="cantidades_productos" style="width:100%;max-width:700px">			
							</canvas>

						</div>

					</td>


					<td style="border-bottom: 2px dotted;">

						<div>

							<canvas id="cantidades_por_modalidad" style="width:100%;max-width:700px">			
							</canvas>

						</div>

					</td>

				</tr>

				

				<tr>

					<td style="border-right: 2px dotted;">

						<div>

							<canvas id="monto_total_por_servicio" style="width:100%;max-width:700px">			
							</canvas>

						</div>

					</td>


					<td>

						<div>

							<canvas id="monto_total_por_modalidad" style="width:100%;max-width:700px">			
							</canvas>

						</div>

					</td>

				</tr>

			</table>



			<br>

			<canvas id="proyeccion" style="width:100%;max-width:700px;border: solid 1px gray;border-top: 0px;border-right: 0px" >			
			</canvas>


		</div>

	</div>







	<script>

		obtenerDatosEstadisticos();


		function obtenerDatosEstadisticos() {



			mensaje('Obteniendo datos estadisticos...');
		

			$.ajax({

				type: 'GET',

				url: "{{url('contabilidad/estadisticas')}}",
 
				success: function(data) {
					
					desplegarMontosPorModalidadYMes(data['ventasPorMes'],data['reservasPorMes']);
					
					desplegarCantidadesProductos(data['totalPasajes'],data['totalCargas']);
					desplegarCantidadesPorModalidad(data['totalVentas'],data['totalReservas']);
					desplegarMontoTotalPorServicio(data['montoTotalPasaje'],data['montoTotalCarga']);

					desplegarMontoTotalPorModalidad(data['montoTotalVenta'],data['montoTotalReserva']);
					mensaje('');
				
				},
				    
				error: function(data) {

				    mensaje('Error en elservidor');
				 
				},

				timeout:5000

			

			});


		}


		function mensaje(mensaje){
		
			$('#mensaje').html(mensaje);
		
		}

		function desplegarCantidadesProductos(p,ec) {


			var xValues = ["Pasajes", "Espacios de carga"];
			var yValues = [p,ec];

			var barColors = [
			  "#b91d47",
			  "#00aba9"
			];


			new Chart("cantidades_productos", {
				type: "pie",
				data: {
				labels: xValues,
			    datasets: [{
			      backgroundColor: barColors,
			      data: yValues
			    }]
			  },
			  options: {
			    title: {
			      display: true,
			      text: "Cantidades totales de productos vendidos"
			    }
			  }
			});

		}


		function desplegarCantidadesPorModalidad(v,r) {


			var xValues = ["Ventas", "Reservas"];
			var yValues = [v,r];

			var barColors = [
			  "#b91d47",
			  "#00aba9"
			];


			new Chart("cantidades_por_modalidad", {
				type: "pie",
				data: {
				labels: xValues,
			    datasets: [{
			      backgroundColor: barColors,
			      data: yValues
			    }]
			  },
			  options: {
			    title: {
			      display: true,
			      text: "Cantidades totales por modalidad"
			    }
			  }
			});

		}



		function desplegarMontoTotalPorServicio(p,ec) {


			var xValues = ["Pasajes", "Espacios de carga"];
			var yValues = [p,ec];

			var barColors = [
			  "#b91d47",
			  "#00aba9"
			];


			new Chart("monto_total_por_servicio", {
				type: "pie",
				data: {
				labels: xValues,
			    datasets: [{
			      backgroundColor: barColors,
			      data: yValues
			    }]
			  },
			  options: {
			    title: {
			      display: true,
			      text: "Montos totales por productos"
			    }
			  }
			});

		}


		function desplegarMontoTotalPorModalidad(v,r) {


			var xValues = ["Venta", "Reservas"];
			var yValues = [v,r];

			var barColors = [
			  "#b91d47",
			  "#00aba9"
			];


			new Chart("monto_total_por_modalidad", {
				type: "pie",
				data: {
				labels: xValues,
			    datasets: [{
			      backgroundColor: barColors,
			      data: yValues
			    }]
			  },
			  options: {
			    title: {
			      display: true,
			      text: "Montos totales por modalidad"
			    }
			  }
			});

		}





		function desplegarMontosPorModalidadYMes(venta,reserva) {


			var xValues = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];



			new Chart("proyeccion", {

			  type: "line",
			  
			  data: {
			    labels: xValues,
			  
			    datasets: [

			    {
			      data: venta,
			      borderColor: "red",
			      fill: false,
			      label:"Venta"
			    },

			    {
			      data: reserva,
			      borderColor: "green",
			      fill: false,
			      label:"Reserva"
			    }]

			  },


				 options: {
				    title: {
				      display: true,
				      text: "Ventales totales por mes y modalidad"
				    }
				  }
			});


		}
		


	</script>



</body>
</html>