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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

		
		<title>Film'House - Error</title>
	</head>

	<body>
		<?php	require 'includes/Comun/cabecera.php'; ?>
        <div class="content">
          <section>
              <article>
                <img src="<?= $app->resuelve('/img/comun/error.png')?>"/>
              </article>
          </section>
        </div>
        <?php require 'includes/Comun/pie.php'; ?>
	</body>
</html>