<?php
    require_once __DIR__ . "/../config.php";
   

    function session_info() {
        if (isset($_SESSION["login"]) && ($_SESSION["login"] === true)) {
            echo '<a href="logout.php"><i class="fas fa-sign-out-alt" title = "Salir">Hola ' . $_SESSION['nombre'] . '</i></a>';
        }
        else {
            echo '<a href="login.php"><i class="fas fa-sign-in-alt" title = "Iniciar Sesion">Iniciar sesión</i></a>';
        }
    }
?>
<header>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <div class="header">
        <a href= "index.php">
            <img src="img/comun/logotipo.svg" alt="Film'House">
        </a>
        <?=$buscador?>
    </div>
    
    <nav>
        <ul>
            <li><a href='index.php'><i class="fas fa-home" title = "Inicio"> Inicio</i></a></li>
            <li><a href='listapeli.php?variable=id_asc'><i class="fas fa-film"> Peliculas</i></a></li>
            <li><a href='listaserie.php?variable=id_asc'><i class="fas fa-tv"> Series</i></a></li>
            <li><a href='anuncios.php'><i class="fas fa-calendar-alt" title = "Proximos estrenos"> Estrenos</i></a></li>
            <li><a href='perfil.php'><i class="fas fa-id-card" title = "Perfil"> Perfil</i></a></li>
            <li><a href='correo.php'><i class="fas fa-envelope" title = "Correo"> Correo</i></a></li>
            <li class="right"><?php session_info() ?></li>
        </ul>
    </nav>
</header>