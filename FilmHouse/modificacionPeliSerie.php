<?php
	require_once __DIR__ . "/includes/config.php";
    use filmhouse\FormularioModificacionPeliSerie;
    use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();

    $titulo = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_STRING);
	$form = new FormularioModificacionPeliSerie($titulo); 
	$modPS = $form->gestiona();
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
					<h1>Modificacion</h1>
				</div>
				
				<?php
					echo $modPS;
				?>

			</article>
		</section>
	</div>
		<?php	
			require("includes/Comun/pie.php");	
		?>
	</body>
</html>