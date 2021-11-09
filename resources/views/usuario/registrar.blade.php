<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Usuario</title>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/jquery.validate.js') }}"></script>
</head>
<body>


	<div>

		<form id="registrar" action="#">
			
			@csrf
				Sucursal:<select id="sucursal" name="sucursal">

				</select>
				
				<br>
				<br>

				Rol:<select name="tipo">
					<option value="true">Gerente</option>
					<option value="false">Cajero</option>
				</select>

				<br>
				<br>

				Nombre:<input type="text" id="nombre" name="nombre" placeholder="Nombre" >


				<br>
				<br>

				Clave:<input type="text" id="clave" name="clave" placeholder="Clave" >
				
				<br>
				<br>

				Confirmar Clave:<input type="text" id="claveconf" name="claveconf" placeholder="Confirmar clave" >

				<br>
				<br>
				
				<input type="submit" value ="Registrar"/>

		</form>

		<br>
		<br>
		
		<label id="mensaje"></label>

	</div>

	
	<script>

		obtenerSucursales();

		$(document).ready(function(){


			$.extend( $.validator.messages, {
			required: "Este campo es requerido.",
			remote: "Por favor, llene este campo.",
			email: "Por favor, escriba una dirección de correo válida.",
			url: "Por favor, escriba una URL válida.",
			date: "Por favor, escriba una fecha válida.",
			dateISO: "Por favor, escriba una fecha (ISO) válida.",
			number: "Por favor, escriba un número válido.",
			digits: "Por favor, escriba sólo dígitos.",
			creditcard: "Por favor, escriba un número de tarjeta válido.",
			equalTo: "Por favor, escriba el mismo valor de nuevo.",
			extension: "Por favor, escriba un valor con una extensión aceptada.",
			maxlength: $.validator.format( "Por favor, no escriba más de {0} caracteres." ),
			minlength: $.validator.format( "Por favor, no escriba menos de {0} caracteres." ),
			rangelength: $.validator.format( "Por favor, escriba un valor entre {0} y {1} caracteres." ),
			range: $.validator.format( "Por favor, escriba un valor entre {0} y {1}." ),
			max: $.validator.format( "Por favor, escriba un valor menor o igual a {0}." ),
			min: $.validator.format( "Por favor, escriba un valor mayor o igual a {0}." ),
			cedCR: "Por favor, escriba el número de cédula válido."
			} );


			$("#registrar").validate({

				errorPlacement: function(error, element) {
      				
					var nombre = '#'+element.attr('id');
					$('#mensaje').html("Verifica el campo "+$(nombre).attr('placeholder'));

    			},

				rules : {

					nombre : {
                		minlength : 3,
                		required : true
            		},
            		clave : {
            			required : true,
                		minlength : 5
            		},
            		claveconf : {
            			required : true,
                		minlength : 5,
                		equalTo:'#clave'
            		}


				},
				submitHandler:function(form) {
					enviarPeticion();
				},
		
			});



		})


		

		function obtenerSucursales() {



			$.ajax({

			    type: 'GET',

				url: "{{url('sucursal/listar')}}",
				    
				success: function(data) {

					verificarLargo(data);
				
				},
				    
				error: function(data) {
				    $('#mensaje').html('Error en elservidor');
				    $("#registrar :input").prop("disabled",true);
				},

				timeout:5000

			});



		}
		

		function verificarLargo(sucursales) {

			if(sucursales.length>0){
				desplegarSucursales(sucursales);
			}else{
				desactivarCampos();
			}
		
		}

		function desplegarSucursales(sucursales) {
			
			$("#sucursal").html("");


			sucursales.forEach(function(elemento){
				$("#sucursal").append("<option value='"+elemento.id+"'>"+elemento.nombre+"</option>");
			});
				
		}


		function desactivarCampos(){
			$("#registrar :input").prop("disabled",true);
			$("#mensaje").html("No existen sucursales.");
		}

		function enviarPeticion() {
				

			$.ajax({

			    type: 'POST',

				url: "{{url('usuario/registrar')}}",
				    
				data: $("#registrar").serialize(),
				    
				success: function(data) {

						if(data=="") {
							$('#mensaje').html('Compruebe los datos ingresados');
						}else {

							$('#mensaje').html('Se agrego exitosamente');
			    			$('form#registrar').trigger("reset");
			    			
						}

					},
				    
				   error: function(data) {
				       $('#mensaje').html('Error en elservidor');
				   },

				   timeout:5000

				});


			}
			

	</script>


</body>
</html>