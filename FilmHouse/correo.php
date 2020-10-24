<?php
    require_once __DIR__ . "/includes/config.php";
    use filmhouse\DAOs\DAO_ForoUsuario;
    use filmhouse\DAOs\ForoUsuario; 
    use filmhouse\DAOs\DAO_Usuario;
    use filmhouse\DAOs\Usuario;
    use filmhouse\Aplicacion;
    use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();

    $app=Aplicacion::getInstance();

    
    $nuevoCorreo = '';
    $contador='';
    $correo='';
    if (!$app->usuarioLogueado()){
        $correo=<<<EOF
                    <div class="title">
                        <h1>Error</h1>
                    </div>
                    <article>
                        <p>Lo sentimos, debe estar logueado para acceder a la badeja de entrada</p>
                    </article>
                    EOF;
    }
    else
    {
        $cont = 0;
        $nuevoCorreo =<<<EOF
                    <article>
                        <a href="nuevoCorreo.php">Redactar Mensaje   <i class="fas fa-feather-alt" title="Nuevo Correo"></i></a>
                    </article>
                    EOF;
        
        $daoForoUsuario = new DAO_ForoUsuario();
        $mensajes = $daoForoUsuario->readAll(0, $app->idUsuario());
        if(!isset($mensajes))
        {
            $correo='';
        }
        if($app->esGestor())
        {
            $peticiones = $daoForoUsuario->readTipo('NuevoElemento');
            if(isset($peticiones))
            {
                foreach($peticiones as $m) {
                    $id = $m->getID();
                    $idorigen = $m->getIDUsu1();
                    $fecha = $m->getFecha();
                    $asunto = $m->getAsunto();
                    $estado = $m->getEstado();
                    $leido = '<i class="fas fa-envelope-open-text" title = "Leido"></i>';
                    if($estado == 0)
                    {
                        $leido = '<i class="fas fa-envelope" title = "Sin Leer"></i>';
                        
                        $cont ++;
                    }
                    $daoUsu = new DAO_Usuario();
                    $origen = $daoUsu->read($idorigen);
                    $nombreOrigen = $origen->getNombre();

                    $icono = '';
                    switch($origen->getRol()){

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

                    $correo .= <<<EOF
                    <a class="no-decoration" href="mensaje.php?mensaje=$id">
                        <div class="mail">
                            <p>
                            $leido |  $icono   $nombreOrigen : $asunto
                            </p>
                            <div class="fecha">
                                <p>
                                    $fecha 
                                </p>
                            </div>
                        </div>
                    </a>
                    EOF;
                } 
            }
        }
        if($app->esMod())
        {
            $peticiones = $daoForoUsuario->readTipo('Peticion');
            if(isset($peticiones))
            {
                foreach($peticiones as $m) {
                    $id = $m->getID();
                    $idorigen = $m->getIDUsu1();
                    $fecha = $m->getFecha();
                    $asunto = $m->getAsunto();
                    $estado = $m->getEstado();
                    $leido = '<i class="fas fa-envelope-open-text" title = "Leido"></i>';
                    if($estado == 0)
                    {
                        $leido = '<i class="fas fa-envelope" title =" Sin Leer"></i>';
                        $cont ++;
                    }
                    $daoUsu = new DAO_Usuario();
                    $origen = $daoUsu->read($idorigen);
                    $nombreOrigen = $origen->getNombre();

                    $icono = '';
                    switch($origen->getRol()){

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

                    $correo .= <<<EOF
                    <a class="no-decoration" href="mensaje.php?mensaje=$id">
                        <div class="mail">
                            <p>
                            $leido |  $icono   $nombreOrigen : $asunto
                            </p>
                            <div class="fecha">
                                <p>
                                    $fecha
                                </p>
                            </div>
                        </div>
                    </a>
                    EOF;
                } 
            }
        }
        if(isset($mensajes))
        {
           foreach($mensajes as $m) {
                $id = $m->getID();
                $idorigen = $m->getIDUsu1();
                $fecha = $m->getFecha();
                $asunto = $m->getAsunto();
                $estado = $m->getEstado();

                $daoUsu = new DAO_Usuario();
                $origen = $daoUsu->read($idorigen);
                $nombreOrigen = $origen->getNombre();
                if($m->getTipo() != 'Peticion' && $m->getTipo() != 'NuevoElemento')
                {
                    $leido = '<i class="fas fa-envelope-open-text" title = "Leido"></i>';
                    if($estado == 0)
                    {
                        $leido = '<i class="fas fa-envelope" title = "Sin Leer"></i>';
                        $cont ++;
                    }

                    $icono = '';
                    switch($origen->getRol()){

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

                    $correo .= <<<EOF
                        <a class="no-decoration" href="mensaje.php?mensaje=$id">
                            <div class="mail">
                                <p>
                                $leido |  $icono  $nombreOrigen: $asunto
                                </p>
                                <div class="fecha">
                                    <p>
                                        $fecha
                                    </p>
                                </div>
                            </div>
                        </a>
                        EOF;
               }       
            } 
        }
        if($cont == 0)
        {
            $contador = <<<EOF
                        <p>Ningún correo pendiente de leer</p>
                        EOF;
        }
        else{
            if($cont == 1)
            {
                $contador = <<<EOF
                            <p>Tienes $cont mensaje sin leer</p>
                            EOF;
            }
            else
            {
                $contador = <<<EOF
                        <p>Tienes $cont mensajes sin leer</p>
                        EOF;
            }
            
        }         
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
                    echo $nuevoCorreo;
                    echo $contador;
                    echo $correo;
                ?>
            </article>
        </section>
    </div>
        <?php require 'includes/Comun/pie.php'; ?>
    </body>
</html>