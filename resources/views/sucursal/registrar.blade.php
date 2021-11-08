<!DOCTYPE html>
<html>
<head>
	<title>Naviera PeP - Registrar Sucursal</title>
</head>
<body>

	<form method="POST" action="{{url('/sucursal/registrar')}}">
		
		@csrf
			<input type="text" name="nombre" required/>
			<br>
			<br>
			<input type="text" name="ciudad" required/>
			<br>
			<br>
			<input type="submit" value ="Registrar"/>

	</form>


</body>
</html>