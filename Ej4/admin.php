<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Portada</title>
</head>

<body>

<div id="contenedor">

	<?php 
		require("cabecera.php"); 
		require("sidebarIzq.php"); 
	?>

	<div id="contenido">
		<?php
			if (!isset($_SESSION["esAdmin"])) {  //Usuario incorrecto
				echo "<h1>Acceso denegado!</h1>";
				echo "<p>No tienes permisos suficientes para administrar la web.</p>";
			}
			else {  //Usuario administrador
		?>
			<h1>Consola de administración</h1>
			<p>Aquí estarían todos los controles de administración.</p>
		<?php
			}
		?>
	</div>

	<?php 
		include("sidebarDer.php"); 
		include("pie.php"); 
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>