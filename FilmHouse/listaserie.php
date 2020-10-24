<?php
    //Inicio del procesamiento
    require_once __DIR__ . "/includes/config.php";
    use filmhouse\DAOs\DAO_Serie;
    use filmhouse\FormularioBusqueda;

    $form = new FormularioBusqueda(); 
    $buscador= $form->gestiona();

    $opcion = isset($_GET['variable']) ? $_GET['variable']: 'id_asc';
    $division = explode("_", $opcion);
    if($division[0]==="id")
    {
        $variable = "_id_serie";
    }
    if($division[0]==="tit")
    {
        $variable = "Titulo";
    }
    if($division[0]==="est")
    {
        $variable = "Estreno";
    }
    if($division[1]==="asc")
    {
        $orden = "ASC";
    }
    if($division[1]==="desc")
    {
        $orden = "DESC";
    }
    $dao = new DAO_Serie();
    $serie = $dao->readAll(0,$variable, $orden);
                

    $listaSeries = '';


    //lista de las peliculas favoritas
    if(!isset($serie)) {
        $listaSeries = "<p> No hay series favoritas todavia </p>";
    }
    else {
        foreach($serie as $s) {
            $titulo = $s->getTitulo();
            $id = $s->getID();
            $estreno = $s->getEstreno();
            $imgs = $s->getImagen();

            $listaSeries .= <<<EOF
            <a class="no-decoration" href="perfilSerie.php?titulo=$titulo">
                <div class="item">
                    <img src="$imgs" alt="Imagen de $titulo"/>
                    <p>
                        <h2>$titulo</h2>
                        Fecha de estreno: $estreno
                    </p>
                </div>
            </a>
            EOF;
        }
    }
    function generarOpcionesOrdenacion($ordenSeleccionado) {
    $opcionesOrdenacion = [
        'id_asc' => 'Por defecto', 'tit_asc' => 'Titulo ascendente', 'tit_desc' => 'Titulo descendente', 'est_asc' => 'Fecha de estreno ascendente', 'est_desc' => 'Fecha de estreno descendente'
    ];
    $html = '';
    foreach($opcionesOrdenacion as $clave => $valor) {
        $html .= '<option value="'.$clave.'"';
        if ($ordenSeleccionado === $clave) {
            $html .= ' selected ="selected"';
        }
        $html .= '>'.$valor.'</option>';
    }
    return $html;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/estilo.css')?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script type="text/javascript" src="<?= $app->resuelve('/js/codigo.js')?>"></script>
        <title>Series | Film'House</title>
    </head>

    <body>
        <?php require("includes/Comun/cabecera.php"); ?>
        <div class="content">
            <section>
                <article>
                    <div class="title">
                    <h1>Lista de series</h1>
                    </div>
                    <div>
                       <label>Ordenar por:</label>
                        <select id="order">
                          <?= generarOpcionesOrdenacion($opcion) ?>
                        </select>
                    </div>
                    <?php echo $listaSeries; ?>
                </article>
            </section>
        </div>
        <?php require("includes/Comun/pie.php"); ?>
    </body>
</html>