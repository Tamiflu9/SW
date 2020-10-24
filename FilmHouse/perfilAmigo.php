<?php
require_once __DIR__ . "/includes/config.php";
use filmhouse\DAOs\DAO_Usuario;
use filmhouse\DAOs\Usuario;
use filmhouse\DAOs\DAO_FavoritosPeli;
use filmhouse\DAOs\DAO_Pelicula;
use filmhouse\DAOs\DAO_FavoritosSerie;
use filmhouse\DAOs\DAO_Serie;
use filmhouse\DAOs\DAO_Amigos;
use filmhouse\DAOs\DAO_ForoUsuario;
use filmhouse\DAOs\ForoUsuario;

use filmhouse\Aplicacion;
use filmhouse\FormularioBusqueda;

$form = new FormularioBusqueda(); 
$buscador= $form->gestiona();

$app = Aplicacion::getInstance();


if(!isset($_GET['nick'])){
    error_log("Error 403: Usuario no especificado.");
    header('Location: '.$app->resuelve('fallo.php'));
    exit();
}

$id = filter_input(INPUT_GET, 'nick', FILTER_SANITIZE_STRING);
if($app->usuarioLogueado()){
    if(!$app->usuarioDis($id)){
        header('Location: '.$app->resuelve('perfil.php'));
        exit();
    }
}
$dao = new DAO_Usuario();
$usuario= $dao->read($id);

if(!isset($usuario)){
    error_log("Error 403: Usuario no encontrado.");
    header('Location: '.$app->resuelve('fallo.php'));
    exit();
}

$descripcion = $usuario->getDescripcion();
$imagen = $usuario->getImagen();
$nombre = $usuario->getNombre();


$daoFavPeli = new DAO_FavoritosPeli();
$pelicula = $daoFavPeli->readAll(0,$usuario->getID());
$daoPeli = new DAO_Pelicula();

$daoFavSerie = new DAO_FavoritosSerie();
$se = $daoFavSerie->readAll(0,$usuario->getID());
$daoSerie = new DAO_Serie();

$daoAmigos = new DAO_Amigos();
$amigos = $daoAmigos->readAll(0,$id);



$botonBan = '';
$daoUsu = new DAO_Usuario();
$user = $daoUsu->read($id);
if ($app->usuarioLogueado() && $app->esAdmin() && $user->getRol() < 3){
    $botonBan = <<<EOF
<article>
    <div class="boton">
        <form method="post">
            <button type="submit" name="ban" value="Banear"><i class="fas fa-user-slash" title  = "Banear"> </i></button>
           <input type="hidden" name="nick" value="<?= $id ?>" />
        </form>
    </div>
</article>
EOF;
}

if($user->getRol() == 0 && $app->esAdmin() && $app->usuarioLogueado()){
    $botonBan .= <<<EOF
    <article>
    <div class="boton">
        <form method="post">
            <button type="submit" name="promote" value="Hacer Moderador"><i class="fas fa-user-shield" title  = "Hacer Moderador"> </i></button>
            <input type="hidden" name="nick" value="<?= $id ?>" />
        </form>
    </div>
</article>
EOF;
}
if($user->getRol() == 1 && $app->esAdmin() && $app->usuarioLogueado()){
    $botonBan .= <<<EOF
    <article>
    <div class="boton">
        <form method="post">
            <button type="submit" name="promote" value="Hacer Gestor"><i class="fas fa-user-cog" title  = "Hacer Gestor"> </i></button>
            <input type="hidden" name="nick" value="<?= $id ?>" />
        </form>
    </div>
</article>
EOF;
}
if(($user->getRol() == 1 || $user->getRol() == 2)  && $app->esAdmin() && $app->usuarioLogueado()){
    $botonBan .= <<<EOF
<article>
    <div class="boton">
        <form method="post">
            <button type="submit" name="demote" value="Degradar"><i class="fas fa-user-minus" title  = "Degradar"> </i></button>
           <input type="hidden" name="nick" value="<?= $id ?>" />
        </form>
    </div>
</article>

EOF;
}



if(array_key_exists('ban',$_POST)){
    $app->borrarPersona($id);
    header('Location: '.$app->resuelve('index.php'));
    exit();
}
if(array_key_exists('promote',$_POST)){
    $app->promocionarPersona($id);
    header('Location: '.$app->resuelve($_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"]));
	exit();
}
if(array_key_exists('demote',$_POST)){
    $app->degradarPersona($id);
    header('Location: '.$app->resuelve($_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"]));
    exit();
}

$botonFav = '';
    if($app->usuarioLogueado()){
        $daoA = new DAO_Amigos();
        $amistad = $daoA->read($app->idUsuario(), $user->getID());
        if(isset($amistad)){
            $botonFav = <<<EOF
            <article>
                <div class="boton">
                    <form method="post">
                        <button type="submit" name="bamigo" value="Borrar Amigo" title="Borrar Amigo"><i class="fas fa-heart-broken" > </i></button>
                    <input type="hidden" name="nick" value="<?= $id ?>" />
                    </form>
                </div>
            </article>
            EOF;
        }
        else{
            $daoMensajes=new DAO_ForoUsuario();
            $solicitud=$daoMensajes->readSolicitud($app->idUsuario(),$user->getID());
            if(!isset($solicitud)){
                $botonFav = <<<EOF
                <article>
                    <div class="boton">
                        <form method="post">
                            <button type="submit" name="amigo" value="Añadir Amigo" title="Añadir Amigo"><i class="fas fa-heart" > </i></button>
                        <input type="hidden" name="nick" value="<?= $id ?>" />
                        </form>
                    </div>
                </article>
                EOF;
            }
        }
    }


if(array_key_exists('amigo',$_POST)){
    $app->mandarSolicitud($id);
    header('Location: '.$app->resuelve($_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"]));
    exit();
}



if(array_key_exists('bamigo',$_POST)){
    $app->borrarAmigo($id);
    header('Location: '.$app->resuelve($_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"]));
    exit();
}


$listaAmigos = '';
$listaPelis  = '';
$listaSeries = '';



//lista de los amigos
if(!isset($amigos)){
    $listaAmigos = "<p> No hay amigos todavía </p>";
}
else{
    foreach($amigos as $a){
        $id_amigo1 = $a->getIDUsu1();
        $id_amigo2 = $a->getIDUsu2();
        if($app->usuarioDisA($id,$id_amigo1))
        {
            $usu1 = $dao->read($id_amigo1);
            $imga = $usu1->getImagen();
            if($app->usuarioDis($id_amigo1))
            {

                $listaAmigos .= <<<EOF
                <a href= "perfilAmigo.php?nick=$id_amigo1"><img id="imgshadow"src="$imga"></a>
                EOF;
            }
            else{
                $listaAmigos .= <<<EOF
                <a href= "perfil.php"><img id="imgshadow"src="$imga"></a>
                EOF;
            }
            

        }
        if($app->usuarioDisA($id,$id_amigo2))
        {
            $usu1 = $dao->read($id_amigo2);
            $imga = $usu1->getImagen();
            if($app->usuarioDis($id_amigo2))
            {

                $listaAmigos .= <<<EOF
                <a href= "perfilAmigo.php?nick=$id_amigo2"><img id="imgshadow"src="$imga"></a>
                EOF;
            }
            else{
                $listaAmigos .= <<<EOF
                <a href= "perfil.php"><img id="imgshadow"src="$imga"></a>
                EOF;
            }
            

        }
        
    }
}  


//lista de las peliculas favoritas
if(!isset($pelicula)){
    $listaPelis = "<p> No hay peliculas favoritas todavia </p>";
}
else{
    foreach($pelicula as $p){
        $id_peli = $p->getIDPeli();
        $peli = $daoPeli->read($id_peli);
        $imgp = $peli->getImagen();
        $titulop = $peli->getTitulo();

        $listaPelis .= <<<EOF
        <a href= "perfilPeli.php?titulo=$titulop"><img id="imgshadow" src="$imgp"></a>
        EOF;
    }
}

//lista de las series favoritas
if(!isset($se)){
    $listaSeries = "<p> No hay series favoritas todavia </p>";
}
else{
    foreach($se as $s){
        $id_serie = $s->getIDSerie();
        $infoserie = $daoSerie->read($id_serie);
        $imgs = $infoserie->getImagen();
        $titulos = $infoserie->getTitulo();

        $listaSeries .= <<<EOF
        <a href= "perfilSerie.php?titulo=$titulos"><img id="imgshadow"src="$imgs"></a>
        EOF;
    }
} 

//icono del rol
$icono = '';
switch($usuario->getRol()){

    case 0:{
        $icono = '<i class="fas fa-user" title = "Usuario"></i>';
    }break;
    case 1:{
        $icono = '<i class="fas fa-user-shield" title = "Moderador"></i>';
    }break;
    case 2:{
        $icono = '<i class="fas fa-user-cog" title = "Gestor"></i>';
    }break;
    case 3:{
        $icono = '<i class="fas fa-crown" title = "Administrador"></i>';
    }break;
}

?>


<!DOCTYPE html>

<html>
	<head>
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
		
		<title>Film'House - Perfil Usuario</title>
	</head>
	<body>
		<?php			
		require 'includes/Comun/cabecera.php';
		
        ?>
        <div class="content">
            <section>
                <article>
                    <div class="titulo">
                        <h1>Perfil de <?=$nombre ?> <?=$icono ?></h1>
                    </div>
                    <div class="imagen">
                        <img src="<?= $imagen ?>">
                    </div>
                </article>
                <div class="botones">

                    <?php
                        echo $botonFav;
                        echo $botonBan;
                    ?>
                </div>
                <article>
                    <div class="info">
                        <fieldset>
                            <legend>Descripción</legend>
                            <?=$descripcion ?>
                        </fieldset>
                    </div>       
                </article>

                <div class="title">
                    <h2>Lista de amigos</h2>
                </div >
                <article class="imagenperfil">

                    <?php
                        echo $listaAmigos;
                    ?> 
                    
                </article> 

                <div class="title"> 
                    <h2>Lista de peliculas favoritas</h2>
                </div>
                <article class="imagenperfil">
                    <?php
                        echo $listaPelis;
                    ?>  
                      
                </article>

                <div class="title">
                    <h2>Lista de series favoritas</h2>
                </div>
                <article class="imagenperfil">

                    <?php
                        echo $listaSeries;  
                    ?> 
                    
                </article> 

        </section>
    </div>
        <?php
            require 'includes/Comun/pie.php';
		?>
	</body>
</html>