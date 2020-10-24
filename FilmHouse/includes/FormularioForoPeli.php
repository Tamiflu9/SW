<?php
namespace filmhouse;
use filmhouse\DAOs\DAO_Pelicula;
use filmhouse\DAOs\Pelicula;
use filmhouse\DAOs\DAO_ForoPelicula;
use filmhouse\DAOs\ForoPelicula;
use filmhouse\Aplicacion;
use filmhouse\DAOs\DAO_ForoUsuario;
use filmhouse\DAOs\ForoUsuario;



class FormularioForoPeli extends Form
{
    public function __construct() {
        parent::__construct('formfpeli');
    }

    protected function generaCamposFormulario($datos)
    {

        $mensaje = '';
        $peli = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_STRING);
        if ($datos) {
            $mensaje = isset($datos['mensaje']) ? $datos['mensaje'] : $mensaje;
        }
        $html = <<<EOF
		<fieldset>
            <div class="grupo-control">
                <label>Mensaje:</label> 
                    <p><textarea name="mensaje" value="$mensaje" rows="10"></textarea></p>
            </div>
            <input type="hidden" name="peli" value= "$peli" >
			<div class="grupo-control"><button type="submit" name="mensajepeli">Enviar</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);
        $app = Aplicacion::getInstance();

        if(!$app->usuarioLogueado()){
            $errores[] = "Debes estar logueado para poder mandar mensajes";
        }
        else{
            $peli = isset($datos['peli']) ? $enlace->real_escape_string($datos['peli']) : null;
            
            if ( empty($peli)) {
                $errores[] = "Ha ocurrido un error inesperado";
            }else{
                $daoP = new DAO_Pelicula();
                $idPeli = $daoP->dameID($peli);
                if(!isset($idPeli)){
                    $errores[] = "Ha ocurrido un error inesperado";
                }
            }
            
            $mensaje = isset($datos['mensaje']) ? $enlace->real_escape_string($datos['mensaje']) : null;
            if ( empty($mensaje) || mb_strlen($mensaje) < 1 ) {
                $errores[] = "El mensaje no es correcto";
            }

            
            $fecha = getdate();

            if ( empty($fecha) ) 
                $errores[] = "Se ha producido un error";
            
            $fecha = $fecha['year'] . "-" . $fecha['mon'] . "-" .$fecha['mday'] . " " . $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];
            if (count($errores) === 0) {
                $dao = new DAO_ForoPelicula();
                $idUser = $app->idUsuario();
                $s = new ForoPelicula(0, $idPeli, $idUser, $mensaje, $fecha);
                $dao->create($s);

                if(!$app->esMod())
                {
                    $daoPeticion = new DAO_ForoUsuario();
                    $peticion = new ForoUsuario(0, $app->idUsuario(), 'administrador', 'Pelicula '.$peli , $mensaje, 0, $fecha, 'Peticion');
                    $daoPeticion->create($peticion);
                }

                $errores = 'perfilPeli.php?titulo='.$peli;
            
            }
        }
            return $errores;
        
    }
}