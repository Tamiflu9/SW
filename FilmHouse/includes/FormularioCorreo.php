<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_ForoUsuario;
use filmhouse\DAOs\ForoUsuario;
use filmhouse\DAOs\DAO_Usuario;
use filmhouse\DAOs\Usuario;
use filmhouse\Aplicacion;

class FormularioCorreo extends Form
{
    public function __construct() {
        parent::__construct('formCorreo');
    }

    protected function generaCamposFormulario($datos)
    {
        $_id_Destino = '';
        $asunto = '';
        $mensaje = '';
        if ($datos) {
            $_id_Destino     = isset($datos['_id_Destino']) ? $datos['_id_Destino'] : $_id_Destino;
            $asunto = isset($datos['asunto']) ? $datos['asunto'] : $asunto;
            $mensaje  = isset($datos['mensaje']) ? $datos['mensaje'] : $mensaje;
        }
        $html = <<<EOF
		<fieldset>
			<div class="grupo-control">
				<label>Para:</label> <input class="control" type="text" name="_id_Destino" value="$_id_Destino" />
            </div>
            <div class="grupo-control">
                <label>Asunto:</label> <input class="control" type="text" name="asunto" value="$asunto" />
            </div>
            <div class="grupo-control">
                <label>Mensaje:</label> 
                    <p><textarea name="mensaje" value="$mensaje" rows="10"></textarea></p>
            </div>			
            <div class="grupo-control"><button type="submit" name="mensajeusu">Enviar</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $app = Aplicacion::getInstance();
        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);

        $_id_Destino = isset($datos['_id_Destino']) ? $enlace->real_escape_string($datos['_id_Destino']) : null;
        
        if ( empty($_id_Destino)) {
            $errores[] = "El titulo no puede ser un campo vacío.";
        }
        else
        {
            $daoUsu = new DAO_Usuario();
            $usuDes = $daoUsu->read($_id_Destino);
            if(!isset($usuDes))
            {
                $errores[] = "El destinatario no existe.";
            }
            else
            {
                if(!$app->usuarioDis($usuDes->getID()))
                {
                    $errores[] = "El destinatario no puedes ser tu mismo.";
                }
            }
        }
        
        $asunto = isset($datos['asunto']) ? $enlace->real_escape_string($datos['asunto']) : null;

        $mensaje = isset($datos['mensaje']) ? $enlace->real_escape_string($datos['mensaje']) : null;

        if(empty($mensaje)){
            $errores[] = "El mensaje no puede ser un campo vacío. ";
        }
        
        $fecha = getdate();

        if ( empty($fecha) ) 
            $errores[] = "Se ha producido un error";
        
        $fecha = $fecha['year'] . "-" . $fecha['mon'] . "-" .$fecha['mday'] . " " . $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];

        if (count($errores) === 0) {
            $dao = new DAO_ForoUsuario();
            $f = new ForoUsuario(0, $app->idUsuario(), $_id_Destino, $asunto, $mensaje, 0, $fecha, 'Mensaje');
            $dao->create($f);
            $errores = 'correo.php';
        }
        return $errores;
    }
}