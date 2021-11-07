<!DOCTYPE html>
<html>
<head>
	<title>Hola</title>
</head>
<body>

	<form method="POST" action="{{url('/sucursal/registrar')}}">
		
		@csrf
			<input type="text" name="nombre"/>
			<br>
			<br>
			<input type="text" name="ciudad">
			<br>
			<br>
			<input type="submit" value ="Registrar">

	</form>


</body>
</html>