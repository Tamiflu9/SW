<?php
    require_once __DIR__ . "/includes/config.php";
    use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Próximos estrenos | Film'House</title>
    </head>
    <body>
        <?php require 'includes/Comun/cabecera.php'; ?>
        <div class="content">
            <section>
                <article>
                    <div class="title">
                        <h1>Próximos estrenos</h1>
                    </div>
                    <div class="avisos">
                        <div class="contenido">
                            <div clas="encabezado">Avisos</div>
                                <ul>
                                    <li class="media">
                                        <p><i class="fas fa-biohazard"></i> Las fechas de estrenos podrían cambiar debido al COVID-19</p>
                                    </li>
                                </ul>
                        </div>
                    </div>
                        <fieldset class="anuncios">
                            <legend>Abril</legend>
                            <p>No hay estrenos, los cines permanecen cerrados por la pandemia </p>
                        </fieldset>
                        <fieldset class="anuncios">
                            <legend>Mayo</legend>
                            <ul>
                                <li>La mujer de la ventana (15/05/2020)</li>
                                <li>Gretel y Hansel (29/05/2020)</li>
                            </ul>
                        </fieldset>
                        <fieldset class="anuncios">
                            <legend>Junio</legend>
                            <ul>
                                <li>Wonder Woman 1984 (04/06/2020)</li>
                                <li>Ofrenda a la tormenta (12/06/2020)</li>
                                <li>Candyman (12/06/2020)</li>
                                <li>Greyhound (19/06/2020)</li>
                            </ul>
                        </fieldset>
                        <fieldset class="anuncios">
                            <legend>Julio</legend>
                            <ul>
                                <li>El practicante (01/07/2020)</li>
                                <li>Free Guy (03/07/2020)</li>
                            </ul>
                        </fieldset>
                        <fieldset class="anuncios">
                            <legend>Agosto</legend>
                            <ul>
                                <li>Bajocero (07/08/2020)</li>
                                <li>Hasta el cielo (28/08/2020)</li>
                            </ul>
                        </fieldset>
                </article>
            </section>
        </div>
        <?php require 'includes/Comun/pie.php'; ?>
    </body>
</html>