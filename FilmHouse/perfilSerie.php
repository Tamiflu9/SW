<?php
    require_once __DIR__ . "/includes/config.php";
    use filmhouse\DAOs\DAO_Serie;
    use filmhouse\Aplicacion;
    use filmhouse\DAOs\DAO_Usuario;
    use filmhouse\DAOs\Usuario;
    use filmhouse\FormularioNota;
    use filmhouse\FormularioForoSerie;
    use filmhouse\DAOs\DAO_FavoritosSerie;
    use filmhouse\DAOs\FavoritosSerie;
    use filmhouse\DAOs\DAO_ForoSerie;
    use filmhouse\DAOs\ForoSerie;
    use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();

    $app = Aplicacion::getInstance();
    $form = new FormularioNota(); 
    $puntuar = $form->gestiona();
    $formMensaje = new FormularioForoSerie(); 

    $mensaje = $formMensaje->gestiona();

    $tituloSerie = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_STRING);

    if(!isset($tituloSerie)) {
        error_log("Error 403: Serie no especificada.");
        header('Location: '.$app->resuelve('fallo.php'));
        exit();
    }

    $dao = new DAO_Serie();
    $id = $dao->dameId($tituloSerie);
    $serie= $dao->read($id);

    if(!isset($serie)) {
        error_log("Error 403: Serie no encontrada.");
        header('Location: '.$app->resuelve('fallo.php'));
        exit();
    }

    $descripcion = $serie->getDescripcion();
    $imagen = $serie->getImagen();
    $fecha = $serie->getEstreno();
    $trailer = $serie->getTrailer();
    $temporadas = $serie->getN_Temporadas();
    $titulo = $serie->getTitulo();

    $botonBorrar = '';

    if($app->usuarioLogueado() && $app->esGestor()){
        $botonBorrar = <<<EOF
        <div class="boton">
            <a href="modificacionPeliSerie.php?titulo=$tituloSerie"><i class="fas fa-edit" title = "Modificar"></i></a>
        </div>
        <div class="boton">
            <form method="post">
                <button type="submit" name="borrar"><i class="fas fa-trash-alt" title= "Borrar Serie"> </i></button>
                <input type="hidden" name="titulo" value="<?= $tituloSerie ?>" />
            </form>
        </div>
    EOF;
    }




    $botonFav = '';
    if ($app->usuarioLogueado()){
        $daoF = new DAO_FavoritosSerie();
        $fav = $daoF->read($app->idUsuario(), $id);
        if(isset($fav)){
            $botonFav = <<<EOF
                <div class="boton">
                    <form method="post">
                    <button type="submit" name="no_me_gusta" value = "no_me_gusta" title  = "Quitar de Favoritos"><i class="fas fa-heart-broken" > </i></button>
                    <input type="hidden" name="serie" value="$id" />
                    </form>
                </div>
            EOF;
        }else{
            $botonFav = <<<EOF
                <div class = "boton">
                    <form method="post">
                        <button type="submit" name="me_gusta" value = "me_gusta" title = "Añadir a Favoritos"><i class="fas fa-heart" > </i></button>
                        <input type="hidden" name="serie" value="$id" />
                    </form>
                </div>
            EOF;
        }
    }


    $campoNota = '';
    if ($app->usuarioLogueado()){
        $campoNota = <<<EOF
                        <div class="nota">
                            $puntuar
                        </div>
                    EOF;
    }

    $listaMensajes = '';

    $daof = new DAO_ForoSerie();
    $id = $dao->dameId($tituloSerie);
    $msj_serie = $daof->readMSG($id);

    if(isset($msj_serie)){
      foreach($msj_serie as $m_sr){
            $autors = $m_sr->getIDUsu();

            $daoUsu = new DAO_Usuario();
            $user = $daoUsu->read($autors);

            $icono = '';
            switch($user->getRol()){
                case 0:{
                    $icono = '<i class="fas fa-user-circle" title = "Usuario"></i>';
                }break;
                case 1:{
                    $icono = '<i class="fas fa-shield-alt" title = "Moderador"></i>';
                }break;
                case 2:{
                    $icono = '<i class="fas fa-cog" title = "Gestor"></i>';
                }break;
                case 3:{
                    $icono = '<i class="fas fa-crown" title = "Administrador"></i>';
                }break;
            }

            $fechas = $m_sr->getFecha();
            $mensajes = $m_sr->getMensaje();
            $id_foro = $m_sr->getID();
            
            $botonMenBorrar = '';
            if($app->usuarioLogueado() && $app->esMod()){
                    $botonMenBorrar = <<<EOF
                    <form method="post">
                        <button type="submit" name="borrarMen"><i class="fas fa-minus-circle" title  = "Borrar Mensaje"> </i></button>
                        <input type="hidden" name="foro" value="$id_foro" />
                    </form>
                EOF;
            }

            $listaMensajes .= <<<EOF
            <p>[$fechas] $icono $autors: $mensajes $botonMenBorrar</p>
            EOF;
        }
    }



    if(array_key_exists('borrar',$_POST)){
        $app->borrarSerie($tituloSerie);
        header('Location: '.$app->resuelve('index.php'));
        exit();
    }
    
    if(array_key_exists('borrarMen',$_POST)){
        $id_foro = filter_input(INPUT_POST, 'foro', FILTER_SANITIZE_NUMBER_INT);

        $app->borrarMensajeSerie($tituloSerie, $id_foro);
        header('Location: '.$app->resuelve($_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"]));
        exit();
    }



    if(array_key_exists('me_gusta',$_POST)){
        $app->anadirSerie($tituloSerie);
        header('Location: '.$app->resuelve($_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"]));
        exit();
    }


    if(array_key_exists('no_me_gusta',$_POST)){
        $app->borrarFavSerie($tituloSerie);
        header('Location: '.$app->resuelve($_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"]));
        exit();
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Información de la película | Film'House</title>
    </head>
    <body>
    
        <?php require 'includes/Comun/cabecera.php'; ?>
        <div class="content">
        <section class="displaced">
                <article class="profile">
                    <div class="info">
                        <img class="outside_img" src="<?=$imagen?>">
                        <div class="left_margin">
                            <h1 class="title"><?=$titulo?></h1>
                            <p>Fecha de estreno: <?=$fecha?></p>
                            <p>Nota: <?=$app->calculoNota($tituloSerie);?></p>
                            <p>Nº de temporadas: <?= $temporadas ?> </p>
                            <?php echo $campoNota; ?>
                        </div>
                    </div>
                    <article>
                        <div class = "botones">
                            <?php
                                echo $botonBorrar;
                                echo $botonFav;
                            ?>
                        </div>
                        <div class="info">
                                <fieldset>
                                    <legend>Descripción</legend>
                                    <?=$descripcion ?>
                                </fieldset>                            
                        </div>
                    </article>
                    <div>
                        <h2>Trailer</h2>
                        <div class="video-container">
                        <iframe width="560" height="315" src="<?php echo $trailer; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div>
                        <h2>Foro</h2>
  
                        <?php 
                            echo $listaMensajes;
                            echo $mensaje;
                        ?>
    
                    </div>
                  
                </article>
                 
            </section>
        </div>
        <?php require 'includes/Comun/pie.php'; ?>
    </body>
</html>