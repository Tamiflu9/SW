<?php
	require_once __DIR__ . "/includes/config.php";
	use filmhouse\FormularioContestar;
	use filmhouse\FormularioBusqueda;

	$form = new FormularioContestar(); 
	$contestacion = $form->gestiona();

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();
?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>"/>
		
		<title>Film'House - Contestar correo</title>
	</head>
	<body>
		<?php require("includes/Comun/cabecera.php"); ?>
		<div class="content">
		<section>
			<article>
				<div class="title">
					<h1>Contestación</h1>
				</div>
				<?php echo $contestacion; ?>
			</article>
		</section>
	</div>
		<?php require("includes/Comun/pie.php"); ?>
	</body>
</html>