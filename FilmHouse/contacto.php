<?php
	require_once __DIR__ . "/includes/config.php";
	use filmhouse\FormularioBusqueda;

	$form = new FormularioBusqueda(); 
	$buscador= $form->gestiona();
?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>"/>
		
		<title>Film'House - Contacto</title>
	</head>
	<body>
		<?php require 'includes/Comun/cabecera.php'; ?>
		<div class="content">
			<section>
				<article>
					<div class="title">
						<h1>Contacto</h1>
					</div>
					<form action="mailto:correo_ejemplo@ucm.es" method="post" enctype="text/plain">
						<fieldset>
							<legend>Información:</legend>
							<p>Nombre: <input type="text" size="50"></p>
							<p>Dirección de email: <input type="text" size="50"></p>
							<p>Motivo de la consulta:</p>
								<p><input type="radio" name="consulta" value="evaluacion"/>Evaluación</p>
								<p><input type="radio" name="consulta" value="sugerencias"/>Sugerencias</p>
								<p><input type="radio" name="consulta" value="criticas"/>Críticas</p>
							<p><input name="terminos" type="checkbox" value="Terminos"/>Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio</p>
							<p><textarea name="consultas" rows="4" cols="50">Escriba su consulta aquí</textarea></p>
							
							<input type="submit" value="Enviar formulario"></input>
							<input type="reset" value="Borrar todo"> </input>
						</fieldset>
					</form>
				</article>
			</section>
		</div>
		<?php require 'includes/Comun/pie.php'; ?>
	</body>
</html>