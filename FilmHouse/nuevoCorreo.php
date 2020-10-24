<?php
require_once __DIR__ . "/includes/config.php";
use filmhouse\FormularioCorreo;
use filmhouse\FormularioBusqueda;

$form = new FormularioBusqueda(); 
$buscador= $form->gestiona();

$form = new FormularioCorreo(); 
$nuevoCorreo = $form->gestiona();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Nuevo correo</title>
	</head>

	<body>

		<?php
			require("includes/Comun/cabecera.php");
		?>

			<div class="content">
				<section>
					<article>
						<div class="title">
							<h1>Nuevo correo</h1>
						</div>
						<?php
							echo $nuevoCorreo;
						?>
					</article>
				</section>			
			</div>

		<?php
			require("includes/Comun/pie.php");
		?>


	</body>
</html>