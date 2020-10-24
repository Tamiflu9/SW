<?php
    require_once __DIR__ . "/includes/config.php";

    use filmhouse\DAOs\DAO_Serie;
    use filmhouse\DAOs\DAO_Pelicula;
    use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();
    
    $listaPelis  = '';
    $listaSeries = '';

    $daos = new DAO_Serie();
    $series = $daos->readAll(10,"Estreno","DESC");


    foreach($series as $s){
        $titulos = $s->getTitulo();
        $imgs = $s->getImagen();
    

        $listaSeries .= <<<EOF
                        <a href= "perfilSerie.php?titulo=$titulos">
                            <img src="$imgs" alt="Carátula de la serie $titulos">
                        </a>
        EOF;
    }

    $daop = new DAO_Pelicula();
    $pelicula = $daop->readAll(10,"Estreno","DESC");

    foreach($pelicula as $p){
        $titulop = $p->getTitulo();
        $imgp = $p->getImagen();
        
        $listaPelis .= <<<EOF
                        <a href="perfilPeli.php?titulo=$titulop">
                            <img src="$imgp" alt="Carátula de la película $titulop">
                        </a>
        EOF;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Inicio | Film'House</title>
    </head>

    <body>
        <?php require ("includes/Comun/cabecera.php"); ?>
        <div class="content">
            <section>

                <h1>Películas disponibles</h1>
                <article class="index">
                    <?php echo $listaPelis; ?>
                </article>
                <h1>Series disponibles</h1>
                <article class="index">
                    <?php echo $listaSeries; ?>
                </article>
            </section>
        </div>
        <?php require 'includes/Comun/pie.php';?>
    </body>
</html>