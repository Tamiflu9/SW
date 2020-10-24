<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_Serie;
use filmhouse\DAOs\Serie;
use filmhouse\DAOs\DAO_ForoSerie;
use filmhouse\DAOs\ForoSerie;
use filmhouse\Aplicacion;
use filmhouse\DAOs\DAO_ForoUsuario;
use filmhouse\DAOs\ForoUsuario;



class FormularioForoSerie extends Form
{
    public function __construct() {
        parent::__construct('formfserie');
    }

    protected function generaCamposFormulario($datos)
    {

        $mensaje = '';
        $serie = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_STRING);
        if ($datos) {
            $mensaje = isset($datos['mensaje']) ? $datos['mensaje'] : $mensaje;
        }
        $html = <<<EOF
		<fieldset>
            <div class="grupo-control">
                <label>Mensaje:</label> 
                    <p><textarea name="mensaje" value="$mensaje" rows="10"></textarea></p>
            </div>
            <input type="hidden" name="serie" value= "$serie" >
			<div class="grupo-control"><button type="submit" name="mensajeserie">Enviar</button></div>
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
            $serie = isset($datos['serie']) ? $enlace->real_escape_string($datos['serie']) : null;
            
            if ( empty($serie)) {
                $errores[] = "Ha ocurrido un error inesperado";
            }else{
                $daoS = new DAO_Serie();
                $idSerie = $daoS->dameID($serie);
                if(!isset($idSerie)){
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
                $dao = new DAO_ForoSerie();
                $idUser = $app->idUsuario();
                $s = new ForoSerie(0, $idSerie, $idUser, $mensaje, $fecha);
                $dao->create($s);
                if(!$app->esMod())
                {
                    $daoPeticion = new DAO_ForoUsuario();
                    $peticion = new ForoUsuario(0, $app->idUsuario(), 'administrador', 'Serie '.$serie , $mensaje, 0, $fecha, 'Peticion');
                    $daoPeticion->create($peticion);
                }
                
                $errores = 'perfilSerie.php?titulo='.$serie;
            
            }
        }
            return $errores;
        
    }
}