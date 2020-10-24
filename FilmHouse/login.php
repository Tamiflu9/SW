<?php

//Inicio del procesamiento
require_once __DIR__ . "/includes/config.php";
use filmhouse\FormularioLogin;
use filmhouse\FormularioBusqueda;

$form = new FormularioBusqueda(); 
$buscador= $form->gestiona();

$form = new FormularioLogin(); 
$login = $form->gestiona();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Portada</title>
	</head>

	<body>

		<?php
			require("includes/Comun/cabecera.php");
		
		?>

			<div class="content">

				<section>
					<div class="title">
					<h1>Acceso al sistema</h1>
				</div>
				<?php
					echo $login;
				?>
			
				</section>
				
			</div>

		<?php
			require("includes/Comun/pie.php");
		?>

	</body>
</html>