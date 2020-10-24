<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_Pelicula;
use filmhouse\DAOs\Pelicula;
use filmhouse\DAOs\DAO_Serie;
use filmhouse\DAOs\Serie;
use filmhouse\Aplicacion;
define('IMG_SERIE', 'img/series/');
define('IMG_PELI', 'img/peliculas/');

$app = Aplicacion::getInstance();
if (! $app->usuarioLogueado()) {
    // Con esto lo redirigimos direcamente a la raiz, también podría ser a una página de error genérica 403.php <=> NO tienes permiso
    error_log("Error 403: Usuario no registrado.");
    header('Location: '.$app->resuelve('fallo.php'));
    exit();
}


class FormularioModificacionPeliSerie extends Form
{
    private $titulo;

    public function __construct($titulo) {
        $this->titulo = $titulo;
        parent::__construct('formModificacionPeliSerie');
    }

    
    protected function generaCamposFormulario($datos)
    {
        $descripcion = '';
        $imagen = '';
        if ($datos) {
            $descripcion     = isset($datos['descripcion']) ? $datos['descripcion'] : $descripcion;
            $imagen =  isset($datos['imagen']) ? $datos['imagen'] : $nombre;
        }
        $html = <<<EOF
		<fieldset>
            <div class="grupo-control">
                <label>Descripción:</label> <textarea class="control" type="text" name="descripcion" value="$descripcion" rows="4" cols="50"></textarea>
            </div>
			<div class="grupo-control">
				<label>Nombre Imagen:</label> <input class="control" type="text" name="imagen" value="$imagen" />
			</div>
			<div class="grupo-control"><button type="submit" name="modificacion">Modificar datos</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        


        $app = Aplicacion::getInstance();
        if (! $app->usuarioLogueado()) {
            // Con esto lo redirigimos direcamente a la raiz, también podría ser a una página de error genérica 403.php <=> NO tienes permiso
            error_log("Error 403: Usuario no registrado.");
            header('Location: '.$app->resuelve('fallo.php'));
            exit();
        }

        $daoP = new DAO_Pelicula();
        $daoS = new DAO_Serie();
        error_log($this->titulo);
        $peliID = $daoP->dameID($this->titulo);
        if(!isset($peliID)){
            $serieID = $daoS->dameID($this->titulo);
            if(!isset($serieID)){
                error_log("Error 403: El elemento no existe.");
                header('Location: '.$app->resuelve('fallo.php'));
                exit();
            }
            else{
                $elemento = $daoS->read($daoS->dameID($this->titulo));
                $folder = IMG_SERIE;
                $esSerie = true;
            }
        }
        else{
            $elemento = $daoP->read($daoP->dameID($this->titulo));
            $folder = IMG_PELI;
        }

        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);

        $descripcion = isset($datos['descripcion']) ? $enlace->real_escape_string($datos['descripcion']) : null;
        if($descripcion == NULL)
        {
            $descripcion = $elemento->getDescripcion();
        }
        else{
            if($descripcion == $elemento->getDescripcion())
            {
                $errores[] = "Los datos no pueden ser los mismos que antes";
            }
        }

        $imagen = isset($datos['imagen']) ? $enlace->real_escape_string($datos['imagen']) : null;

        if($imagen == NULL)
        {
            $imagen = $elemento->getImagen();
        }
        else{
            if($imagen != $elemento->getImagen())
            {
                
                $imagen = $folder . $imagen . ".png";
            }
            else
            {
                $errores[] = "Los datos no pueden ser los mismos que antes";
            }
            
        } 
        
        
        if (count($errores) === 0) {

            if(isset($esSerie)){
                $mod = new Serie($elemento->getID(),$elemento->getTitulo(),$descripcion,$imagen,$elemento->getTrailer(),$elemento->getN_Temporadas(),$elemento->getEstreno());
                $daoS->update($mod);
                $errores = 'perfilSerie.php?titulo='. $elemento->getTitulo();
            }
            else{
                $mod = new Pelicula($elemento->getID(),$elemento->getTitulo(),$descripcion,$imagen,$elemento->getTrailer(),$elemento->getEstreno());
                $daoP->update($mod);
                $errores = 'perfilPeli.php?titulo='. $elemento->getTitulo();
            }

        }
        return $errores;
    }
}