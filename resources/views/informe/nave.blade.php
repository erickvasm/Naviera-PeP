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
					
					

					if(data.length>0){

						console.log(data);


						mensaje('');


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


		function mensaje(mensaje){
		
			$('#mensaje').html(mensaje);
		
		}

	</script>


</body>
</html>