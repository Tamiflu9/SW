<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_ForoUsuario;
use filmhouse\DAOs\ForoUsuario;
use filmhouse\Aplicacion;

$app = Aplicacion::getInstance();

class FormularioContestar extends Form
{
    public function __construct() {
        parent::__construct('formContestar');
    }

    protected function generaCamposFormulario($datos)
    {
        $texto = '';
        $idForo = filter_input(INPUT_GET, 'mensaje', FILTER_SANITIZE_NUMBER_INT);
        if ($datos) {
            $texto  = isset($datos['texto']) ? $datos['texto'] : $texto;
        }
        $html = <<<EOF
		<fieldset>
            <div class="grupo-control">
                <label>Mensaje:</label> 
                    <p><textarea name="texto" value="$texto" rows="4" cols="50"></textarea></p>
            </div>
			<input type="hidden" name="idForo" value= "$idForo" >
            <div class="grupo-control"><button type="submit" name="mensajepeli"><i class="fas fa-reply" title  = "Responder"></i></button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);

        $idForo = isset($datos['idForo']) ? $enlace->real_escape_string($datos['idForo']) : null;
        
        if ( empty($idForo)) {
            $errores[] = "Ha ocurrido un error inesperado";
        }else{
            $daoF = new DAO_ForoUsuario();
            $foro = $daoF->read($idForo);
            if(!isset($foro)){
                $errores[] = "Ha ocurrido un error inesperado";
            }
        }
            
        $texto = isset($datos['texto']) ? $enlace->real_escape_string($datos['texto']) : null;

        if(empty($texto)){
            $errores[] = "Tiene que escribir algo en el mensaje";
        }

        $fecha = getdate();

        if ( empty($fecha) ) 
            $errores[] = "Se ha producido un error";
        
        $fecha = $fecha['year'] . "-" . $fecha['mon'] . "-" .$fecha['mday'] . " " . $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];
        
        if (count($errores) === 0) {
            $foro->setEstado(2);
            $daoF->update($foro);
            $asunto = $foro->getAsunto();
            $emisor = $foro->getIDUsu2();
            $destino = $foro->getIDUsu1();
            $f = new ForoUsuario(0, $emisor, $destino, 'RE: '.$asunto, $texto, 0, $fecha, 'Mensaje');
            $daoF->create($f);
            $errores = 'correo.php';
        }
        return $errores;
    }
}