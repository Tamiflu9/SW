<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_Notas;
use filmhouse\DAOs\Notas;
use filmhouse\Aplicacion;



class FormularioNota extends Form
{
    public function __construct() {
        parent::__construct('formNota');
    }

    protected function generaCamposFormulario($datos)
    {

        $nota = '';
        if ($datos) {
            $nota = isset($datos['nota']) ? $datos['nota'] : $nota;
        }
        $html = <<<EOF
		<fieldset>
            <div class="grupo-control">
                <label>Nota:</label> 
                    <p><textarea name="nota" value="$nota" rows="1" cols="3"></textarea></p>
                    <button type="submit" name="puntuar">Puntua</button>
            </div>
			
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $app = Aplicacion::getInstance();
        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);

        $titulo = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_STRING);

	
        if(!$titulo){
            $errores[] = "No hay un titulo valido";
        }
        

        $nota = isset($datos['nota']) ? $enlace->real_escape_string($datos['nota']) : null;
        if ( empty($nota) || !is_numeric($nota) || $nota > 11 || $nota < 0) {
            $errores[] = "Tiene que haber una nota válida";
        }
        
        if (count($errores) === 0) {
            $dao = new DAO_Notas();
            $id = $app->idUsuario();
	        $not = $dao->read($titulo, $id);
            if (!empty($not)) {
                $dao->update(new Notas($not->getID(),$not->getTitulo(),$not->getUsuario(),$nota));
            } else {
                $s = new Notas(0, $titulo, $id,$nota);
                $dao->create($s);
                $errores = $_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"];
            }
        }
        return $errores;
    }
}