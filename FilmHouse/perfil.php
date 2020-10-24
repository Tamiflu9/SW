<?php
require_once __DIR__ . "/includes/config.php";
use filmhouse\DAOs\DAO_Usuario;
use filmhouse\DAOs\DAO_FavoritosPeli;
use filmhouse\DAOs\DAO_Pelicula;
use filmhouse\DAOs\DAO_FavoritosSerie;
use filmhouse\DAOs\DAO_Serie;
use filmhouse\DAOs\DAO_Amigos;
use filmhouse\Aplicacion;
use filmhouse\FormularioBusqueda;

$form = new FormularioBusqueda(); 
$buscador= $form->gestiona();


$app = Aplicacion::getInstance();
if (!$app->usuarioLogueado()){
    // Con esto lo redirigimos direcamente a la raiz, también podría ser a una página de error genérica 403.php <=> NO tienes permiso
    error_log("Error 403: Usuario no registrado.");
    header('Location: '.$app->resuelve('fallo.php'));
}
$id = $app->idUsuario();


$dao = new DAO_Usuario();
$usuario= $dao->read($id);

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
$amigos = $daoAmigos->readAll(0,$usuario->getID());

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

            $listaAmigos .= <<<EOF
            <a href= "perfilAmigo.php?nick=$id_amigo1"><img id="imgshadow" src="$imga"></a>
            EOF;

        }
        if($app->usuarioDisA($id,$id_amigo2))
        {
            $usu2 = $dao->read($id_amigo2);
            $imga = $usu2->getImagen();

            $listaAmigos .= <<<EOF
            <a href= "perfilAmigo.php?nick=$id_amigo2"><img id="imgshadow" src="$imga"></a>
            EOF;
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
        <a href= "perfilSerie.php?titulo=$titulos"><img id="imgshadow" src="$imgs"></a>
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
                <div class="title">
                    <h1>Perfil de <?=$nombre ?> <?=$icono?> </h1>
                </div>
            <article class="imagenperfil">
                <img src="<?= $imagen ?>">
            </article>
            <article>
                <div class="botones">
                <!--Botones de ajustes-->
                    <div class="botones">
                        <a href="modificacion.php"><i class="fas fa-user-edit" title = "Ajustes de la cuenta"></i></a>
                    </div>
                    <div class="botones">
                        <a href="nuevaPeli.php"><i class="fas fa-plus" title="Añadir Pelicula"> Pelicula</i> </a>
                    </div>
                    <div class="botones">
                        <a href="nuevaSerie.php"><i class="fas fa-plus" title="Añadir Serie"> Serie</i> </a>
                    </div>
                </div>
            </article>
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