<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Portada</title>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/ejercicio4.js"></script>
</head>

<body>

<div id="contenedor">

	<?php 
		require("cabecera.php"); 
		require("sidebarIzq.php"); 
	?>

	<div id="contenido">
	
		<h1>Registro de nuevo usuario</h1>

		<form action="index.php" method="POST">
		<fieldset>
		<legend>Datos del usuario</legend>
		<p><label>Correo:</label> <input required type="email" name="email" id="campoEmail" />
					<span id="correoOK"></span>
		</p>
		<p><label>User:</label> <input required type="text" name="username" id="campoUser" />
			<span id="userOK"></span>
		</p>
		<p><label>Password:</label> <input required type="password" name="password" /><br /></p>
		<button type="submit">Entrar</button>
		</fieldset>
		</form>

	</div>

	<?php 
		include("sidebarDer.php"); 
		include("pie.php"); 
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>