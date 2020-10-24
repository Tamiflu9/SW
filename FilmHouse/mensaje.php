<?php
    require_once __DIR__ . "/includes/config.php";
    use filmhouse\DAOs\DAO_ForoUsuario;
    use filmhouse\DAOs\ForoUsuario; 
    use filmhouse\DAOs\DAO_Usuario;
    use filmhouse\DAOs\Usuario;
    use filmhouse\Aplicacion;
    use filmhouse\FormularioContestar;
    use filmhouse\DAOs\DAO_ForoPelicula;
    use filmhouse\DAOs\ForoPelicula;
    use filmhouse\DAOs\DAO_ForoSerie;
    use filmhouse\DAOs\ForoSerie;
    use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();

    $app=Aplicacion::getInstance();
    $form = new FormularioContestar(); 
    $contestacion = $form->gestiona();

    
    $id_mensaje = filter_input(INPUT_GET, 'mensaje', FILTER_SANITIZE_NUMBER_INT);
    if(!$id_mensaje){
        header('Location: '.$app->resuelve('fallo.php'));
        exit();
    }

    $daoForoUsuario = new DAO_ForoUsuario();
    $info = $daoForoUsuario->read($id_mensaje);
    

    $mensaje='';
    if (!$app->usuarioLogueado() ){
        header('Location: '.$app->resuelve('fallo.php'));
        exit();
    }
    if($info->getTipo() === 'Peticion'){
        if(!$app->esMod()){
            header('Location: '.$app->resuelve('fallo.php'));
            exit();
        }
    }
    else {

        if( $info->getTipo() === 'NuevoElemento'){
            if(!$app->esGestor()){
                header('Location: '.$app->resuelve('fallo.php'));
                exit();
            }
        }
        else if(!($app->idUsuario() === $info->getIDUsu2())){
            header('Location: '.$app->resuelve('fallo.php'));
            exit();
        }
    }

    if($info->getEstado()==0)
    {
        $info->setEstado(1);
        $daoForoUsuario->update($info);
    }

    if($info->getTipo() === 'Mensaje')
    {
        $asunto = $info->getAsunto();
        $texto = $info->getMensaje();
        $daoUsu = new DAO_Usuario();
        $usu = $daoUsu->read($info->getIDUsu1());
        $emisor=$usu->getNombre();
        $mensaje = <<<EOF
                    <article>
                    <div class="botones">
                        <form method="post">
                            <button type="submit" name="borrar" title = "Borrar mensaje"><i class="fas fa-trash-alt" > </i></button>
                        </form>
                    </div>
                    </article>
                    <h2>$asunto</h2>
                    <p>De $emisor:</p>
                    <p>$texto</p>
                EOF; 
        if($info->getEstado() < 2)
        {
            $mensaje .= <<<EOF
                        <article>
                            <p>$contestacion</p>
                        </article>
                    EOF;
        }  
    }

    else if($info->getTipo() === 'Peticion')
    {
        $asunto = $info->getAsunto();
        $texto = $info->getMensaje();
        $daoUsu = new DAO_Usuario();
        $usu = $daoUsu->read($info->getIDUsu1());
        $emisor=$usu->getNombre();

        $mensaje = <<<EOF
                    <h2>$asunto</h2>
                    <p>El usuario $emisor ha publicado este mensaje: $texto</p>
                    <article>
                    <div class="botones">
                        <div class = "boton">
                            <form method="post">
                                <button type="submit" name="borrar" title = "Aceptar Publicacion"><i class="fas fa-check-circle" > </i></button>
                            </form>
                        <div class = "boton">
                        </div>
                            <form method="post">
                                <button type="submit" name="borrarP" title = "Borrar Publicacion"><i class="fas fa-times-circle" > </i></button>
                            </form>
                        </div>
                    </div>
                EOF;   
    }    

    else if($info->getTipo() === 'Solicitud')
    {
        $asunto = $info->getAsunto();
        $daoUsu = new DAO_Usuario();
        $usu = $daoUsu->read($info->getIDUsu1());
        $emisor=$usu->getNombre();
        $mensaje = <<<EOF
                    <h2>$asunto</h2>
                    <p>El usuario $emisor te ha enviado una solicitud de amistad</p>
                    <article>
                    <div class="botones">
                        <div class = "boton">
                            <form method="post">
                            <button type="submit" name="aceptarAmigo" title = "Aceptar"><i class="fas fa-check-circle" > </i></button>
                            </form>
                        </div>
                        <div class = "boton">
                            <form method="post">
                                <button type="submit" name="noAceptarAmigo" title = "Rechazar"><i class="fas fa-times-circle" > </i></button>
                            </form>
                        </div>
                    </div>
                EOF;   
    }  

    else if($info->getTipo() === 'NuevoElemento')
    {
        $asunto = $info->getAsunto();
        $texto = $info->getMensaje();
        $daoUsu = new DAO_Usuario();
        $usu = $daoUsu->read($info->getIDUsu1());
        $emisor=$usu->getNombre();
        $url = $app->resuelve($texto);

        $mensaje = <<<EOF
                    <article>
                        <div class="boton">
                            <form method="post">
                                <button type="submit" name="borrar" title = "Borrar mensaje"><i class="fas fa-trash-alt" > </i></button>
                            </form>
                        </div>
                    </article>
                    <h2>$asunto</h2>
                    <p> El usuario $emisor ha añadido un nuevo elemento</p>
                    <p> Necesita una imagen de portada </p>
                    <a href = "$url"><i class="fas fa-eye" title="Ir a la pagina"></i></a>
                EOF;   
    }

    if(array_key_exists('borrar',$_POST)){
        $app->borrarMensaje($id_mensaje);
        header('Location: '.$app->resuelve('correo.php'));
        exit();
    }

    if(array_key_exists('borrarP',$_POST)){
        $app->borrarPublicacion($id_mensaje);
        $app->borrarMensaje($id_mensaje);
        header('Location: '.$app->resuelve('correo.php'));
        exit();
    }

    if(array_key_exists('aceptarAmigo',$_POST)){
        $app->aceptarAmigo($id_mensaje);
        $app->borrarMensaje($id_mensaje);
        header('Location: '.$app->resuelve('correo.php'));
        exit();
    }

    if(array_key_exists('noAceptarAmigo',$_POST)){
        $app->mensajeRechazo($id_mensaje);
        $app->borrarMensaje($id_mensaje);
        header('Location: '.$app->resuelve('correo.php'));
        exit();
    }

?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Bandeja de entrada | Film'House</title>
    </head>
    <body>
        <?php require 'includes/Comun/cabecera.php'; ?>
        <div class="content">
        <section>
            <article>
                <?php
                    echo $mensaje;
                ?>
            </article>
        </section>
    </div>
        <?php
        require 'includes/Comun/pie.php';
        ?>
    </body>
</html>