<?php
	require_once __DIR__ . "/includes/config.php";
	use filmhouse\FormularioModificacion;
	use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();

	$form = new FormularioModificacion(); 
	$modUsu = $form->gestiona();
?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>"/>
		
		<title>Film'House - Modificación</title>
	</head>
	<body>
		<?php			
			require("includes/Comun/cabecera.php");
		?>
		<div class="content">
		<section>
			<article>
				<div class="title">
					<h1>Modificaciones de datos del usuario</h1>
				</div>
				
				<?php
					echo $modUsu;
				?>

			</article>
		</section>
	</div>
		<?php	
			require("includes/Comun/pie.php");	
		?>
	</body>
</html>