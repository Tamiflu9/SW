<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_Serie;
use filmhouse\DAOs\Serie;
use filmhouse\DAOs\DAO_ForoUsuario;
use filmhouse\DAOs\ForoUsuario;
use filmhouse\Aplicacion;

class FormularioSerie extends Form
{
    public function __construct() {
        parent::__construct('formSerie');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $titulo = '';
        $descripcion = '';
        $trailer = '';
        $imagen ='';
        $estreno = '';
        $ntemporadas = '';
        if ($datos) {
            $titulo     = isset($datos['titulo']) ? $datos['titulo'] : $titulo;
            $descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : $descripcion;
            $trailer  = isset($datos['trailer']) ? $datos['trailer'] : $trailer;
            $imagen  = isset($datos['imagen']) ? $datos['imagen'] : $imagen;
            $estreno  = isset($datos['estreno']) ? $datos['estreno'] : $estreno;
            $ntemporadas  = isset($datos['ntemporadas']) ? $datos['ntemporadas'] : $ntemporadas;
        }
        $html = <<<EOF
		<fieldset>
			<div class="grupo-control">
				<label>Título:</label> <input class="control" type="text" name="titulo" value="$titulo" />
            </div>
            <div class="grupo-control">
                <label>Sinopsis:</label> 
                    <p><textarea name="descripcion" value="$descripcion" rows="4" cols="50"></textarea></p>
            </div>
			<div class="grupo-control">
				<label>URL del trailer:</label> <input class="control" type="text" name="trailer" value="$trailer" />
			</div>
			<div class="grupo-control">
                <label>Fecha de estreno:</label> <input class="control" type="text" name="estreno" value="$estreno" /><br /></div>
            <div class="grupo-control">
                <label>Nº de temporadas:</label> <input class="control" type="text" name="ntemporadas" value="$ntemporadas" />
            </div>
			<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);
        $app=Aplicacion::getInstance();


        $titulo = isset($datos['titulo']) ? $enlace->real_escape_string($datos['titulo']) : null;
        
        if ( empty($titulo)) {
            $errores[] = "El titulo no puede ser un campo vacío.";
        }
        
        $descripcion = isset($datos['descripcion']) ? $enlace->real_escape_string($datos['descripcion']) : null;
        if ( empty($descripcion) || mb_strlen($descripcion) < 5 ) {
            $errores[] = "La descripción tiene que tener una longitud de al menos 5 caracteres.";
        }

        $trailer = isset($datos['trailer']) ? $enlace->real_escape_string($datos['trailer']) : null;

        if(empty($trailer) || !filter_var($trailer, FILTER_VALIDATE_URL)){
            $errores[] = "El trailer no puede ser un campo vacío y tiene que ser una dirección URL. ";
        }
        
        $partir = explode("v=", $trailer);

        $trailer = 'https://www.youtube.com/embed/' . $partir[1];

        $myregex = "/\d{4}\-\d{2}\-\d{2}/";
        $estreno = isset($datos['estreno']) ? $enlace->real_escape_string($datos['estreno']) : null;
        $comprueba = filter_var($estreno, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=> $myregex)));

        if ( empty($estreno) || !$comprueba ) 
            $errores[] = "La fecha tiene que tener una estructura 0000-00-00.";

        $ntemporadas = isset($datos['ntemporadas']) ? $datos['ntemporadas'] : null;

        if(empty($trailer)){
            $errores[] = "El nº de temporadas tiene que ser un número entero ";
        }
        
        if (count($errores) === 0) {
            $dao = new DAO_Serie();
	        $serie = $dao->readTitulo($titulo);
            if ( !empty($serie) ) {
                $errores[] = "La serie a introducir ya esta registrado";
            } else {
                $s = new Serie(0, $titulo, $descripcion, "img/series/predeterminado.png", $trailer, $ntemporadas, $estreno);
                $dao->create($s);

                if(!$app->esGestor())
                {
                    $daoPeticion = new DAO_ForoUsuario();
                    $fecha = getdate();
        
                    $fecha = $fecha['year'] . "-" . $fecha['mon'] . "-" .$fecha['mday'] . " " . $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];
                    $peticion = new ForoUsuario(0, $app->idUsuario(), 'administrador', 'Nueva Serie: '. $titulo , 'perfilSerie.php?titulo='. $titulo, 0, $fecha, 'NuevoElemento');
                    $daoPeticion->create($peticion);
                }

                $errores = 'perfilSerie.php?titulo='. $titulo;
            }
        }
        return $errores;
    }
}