<?php
namespace filmhouse;
use filmhouse\DAOs\DAO_Pelicula;
use filmhouse\DAOs\DAO_Serie;
use filmhouse\DAOs\DAO_Usuario;
use filmhouse\DAOs\Pelicula;
use filmhouse\DAOs\Serie;
use filmhouse\DAOs\Usuario;
use filmhouse\Aplicacion;

class FormularioBusqueda extends Form
{
    public function __construct() {
        parent::__construct('formBusqueda');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $search = '';
        $tipo = '';
        if ($datos) {
            $search = isset($datos['search']) ? $datos['search'] : $search;
            $tipo = isset($datos['tipo']) ? $datos['tipo'] : $tipo;
        }
        $html = <<<EOF
        <div class="radios">
        <input type="radio" id="pelis" name="tipo" value="pelis" checked>
        <label for="pelis">Películas y series</label><br>
        <input type="radio" id="usuarios" name="tipo" value="usuarios">
        <label for="usuarios">Usuarios</label><br>
        </div>
        <div class="busqueda">
        <input class="search" type="text" name="search" placeholder="Buscar en Film'House...">
        </div>
        EOF;
        return $html;
    }
    
    protected function procesaFormulario($datos)
    {
        $app = Aplicacion::getInstance();
        $errores = array();
        $enlace=new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);

        $tipo = isset($datos['tipo']) ? $enlace->real_escape_string($datos['tipo']) : NULL;

        if (empty($tipo)) {
             $errores[] = "Este campo debe estar marcado";
        }
        else if ($tipo === "pelis") {
                $titulo = isset($datos['search']) ? $enlace->real_escape_string($datos['search']) : NULL;
                    
                if ( empty($titulo) ) {
                    $errores[] = "Este campo no puede estar vacío";
                }
                
                if (count($errores) === 0) {
                    $daoPeli = new DAO_Pelicula();
                    $idpeli = $daoPeli->dameId($titulo);
                    $peli = $daoPeli->read($idpeli);
                    if(empty($peli)){
                        $daoSerie = new DAO_Serie();
                        $idserie = $daoSerie->dameId($titulo);
                        $serie = $daoSerie->read($idserie);
                        if(empty($serie))
                        {
                            $errores[] = "El título no coincide";
                        }
                        else
                        {
                            $errores = 'perfilSerie.php?titulo='.$titulo;
                        }
                    }
                    else
                    {
                        $errores = 'perfilPeli.php?titulo='.$titulo;
                    }
            }
        }
        else if ($tipo === "usuarios") {
            $id = isset($datos['search']) ? $enlace->real_escape_string($datos['search']) : NULL;
                
            if ( empty($id) ) {
                $errores[] = "El nombre de usuario no puede estar vacío";
            }
            
            if (count($errores) === 0) {
                $dao = new DAO_Usuario();
                $u = $dao->read($id);
                if ( empty($u) ) {  
                    // No se da pistas a un posible atacante
                    $errores[] = "El usuario no coincide";
                } else {
                    if($app->usuarioLogueado() && !$app->usuarioDis($u->getID())){
                        $errores = 'perfil.php';
                    }else{
                        $errores = 'perfilAmigo.php?nick='.$u->getID();
                    }
                }
            }  
        }
        return $errores;
    }
}