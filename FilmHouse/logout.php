<?php

//Inicio del procesamiento
require_once __DIR__ . "/includes/config.php";
use filmhouse\FormularioBusqueda;

$form = new FormularioBusqueda(); 
$buscador= $form->gestiona();


//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["nombre"]);
unset($_SESSION["id"]);
unset($_SESSION["rol"]);

session_destroy();
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
				<article>
					<div class="title">
						<h1>Hasta pronto!</h1>
					</div>
				</article>
			</section>
		</div>
		

	<?php
		require("includes/Comun/pie.php");
	?>


	</body>
</html>