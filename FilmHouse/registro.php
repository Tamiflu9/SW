<?php
	require_once __DIR__ . "/includes/config.php";
	use filmhouse\FormularioRegistro;
	use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();

	$form = new FormularioRegistro(); 
	$registro = $form->gestiona();
?>

<!DOCTYPE html>

<html>
	<head>
		
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>"/>
		
		<title>Film'House - Registro</title>
	</head>
	<body>
		<?php			
			require("includes/Comun/cabecera.php");
		?>
		<div class="content">
		<section>
			<article>
				<h1>Observaciones:</h1>
					<p>Recuerda:</p>
					<p>- Nombre de usuario: Es el identificador para poder iniciar sesión. </p>
					<p>- Nick: Es el nombre visible, puede modificarse en el futuro. </p>
			</article>
			<article>
				<h1>Registro</h1>
				
				<?php
					echo $registro;
				?>

			</article>
		</section>
	</div>
		<?php	
			require("includes/Comun/pie.php");	
		?>
	</body>
</html>